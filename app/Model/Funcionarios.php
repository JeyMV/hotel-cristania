<?php
namespace App\Model;

use PDO;
use PDOException;
use App\Drive\Conexao;

class Funcionarios
{

    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function show($id_funcionario): object
    {

        $funcionarios = self::getInstance()->query("SELECT * FROM tb_funcionarios AS FN
        INNER JOIN tb_auth AS TA ON FN.idfuncionario = TA.id_funcionario
        INNER JOIN tb_cargos AS TC ON FN.id_cargo = TC.idcargo
        WHERE FN.idfuncionario = $id_funcionario");

        return $funcionarios->fetch();
    }

    public static function register($nome, $telefone, $endereco, $id_cargo, $email, $number_pass, $password)
    {

        $erro = '';

        if ($id_cargo <= 0) {
            $erro = 'Selecione o cargo.';
        }

        if ($number_pass <= 0) {
            $erro = 'Fornceça número válido de passe.';
        }

        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $erro = "Endereço de e-mail Inválido.";
        }

        $checkMAil = self::getInstance()->query("SELECT email FROM tb_auth WHERE email = '$email'");
        if ($checkMAil->rowCount() > 0) {
            $erro = 'Email já registado!';
        }

        $parts = explode(" ", $endereco);

        $provincia = $parts[0];

        $bairro = $parts[2];

        $rua = implode(" ", array_slice($parts, 3));
        try {

            $store = self::getInstance()->prepare("INSERT INTO tb_funcionarios 
        (id_cargo, nome, telefone, provincia, bairro, rua, numero_funcionario)
        VALUES(?,?,?,?,?,?,?)");

            $password = password_hash('00000000', PASSWORD_DEFAULT);

            $store->bindValue(1, $id_cargo, PDO::PARAM_INT);
            $store->bindValue(2, $nome, PDO::PARAM_STR);
            $store->bindValue(3, $telefone, PDO::PARAM_STR);
            $store->bindValue(4, $provincia, PDO::PARAM_STR);
            $store->bindValue(5, $bairro, PDO::PARAM_STR);
            $store->bindValue(6, $rua, PDO::PARAM_STR);
            $store->bindValue(7, $number_pass, PDO::PARAM_STR);

            if ($erro == '') {
                if ($store->execute()) {

                    $id_funcionario = self::getInstance()->lastInsertId();

                    $store = self::getInstance()->query("INSERT INTO tb_auth (id_funcionario, email, password)VALUES('$id_funcionario', '$email', '$password')");

                    if ($store) {
                        http_response_code(200);
                        return ['status' => 200, 'msg' => 'Funcionário registado com sucesso.'];
                    }

                } else {
                    http_response_code(401);
                    return ['status' => 401, 'msg' => $store->errorInfo()];

                }
            } else {

                http_response_code(401);
                return ['status' => 401, 'msg' => $erro];
            }


        } catch (PDOException $th) {

            http_response_code(401);
            return ['status' => 401, 'msg' => $th->getMessage()];
        }

    }

    public static function index(): array
    {
        $funcionarios = self::getInstance()->query("SELECT * FROM tb_funcionarios AS FN
        INNER JOIN tb_auth AS TA ON FN.idfuncionario = TA.id_funcionario
        INNER JOIN tb_cargos AS TC ON FN.id_cargo = TC.idcargo
       ");

        return $funcionarios->fetchAll();
    }
}