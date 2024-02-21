<?php
namespace App\Model;

use PDO;
use PDOException;
use App\Drive\Conexao;

class Clientes
{
    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function register($nome, $bi, $telefone, $email, $password): array
    {

        $erro = '';

        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $erro = "Endereço de e-mail Inválido.";
        }

        $checkMAil = self::getInstance()->query("SELECT email FROM tb_clientes WHERE email = '$email'");
        if ($checkMAil->rowCount() > 0) {
            $erro = 'Email já registado!';
        }

        $checkTelefone = self::getInstance()->query("SELECT telefone FROM tb_clientes WHERE telefone = '$telefone'");
        if ($checkTelefone->rowCount() > 0) {
            $erro = 'Telefone já registado!';
        }

        try {
            $store = self::getInstance()->prepare("INSERT INTO tb_clientes(nome, numero_bi, telefone, email, password)
            VALUES(?,?,?,?,?)");

            $password = password_hash($password, PASSWORD_DEFAULT);

            $store->bindValue(1, $nome);
            $store->bindValue(2, $bi);
            $store->bindValue(3, $telefone);
            $store->bindValue(4, $email);
            $store->bindValue(5, $password);

            if ($erro == '') {
                if ($store->execute()) {

                    session_start();
                    $_SESSION['id_cliente'] = self::getInstance()->lastInsertId();

                    http_response_code(200);
                    return ["status" => 200, "msg" => "Conta criada com sucesso! Aguarde"];
                } else {


                    http_response_code(401);
                    return ["status" => 401, "msg" => $store->errorInfo()];
                }
            }

            http_response_code(401);
            return ["status" => 401, "msg" => $erro];

        } catch (PDOException $e) {

            http_response_code(401);
            return ["status" => 401, "msg" => $e->getMessage()];
        }
    }

    public static function show($id_cliente)
    {

        $query = self::getInstance()->prepare("SELECT * FROM tb_clientes WHERE id_cliente = ?");
        $query->execute([$id_cliente]);
        $cliente = $query->fetch(PDO::FETCH_ASSOC);

        return $cliente;

    }

    public static function getAll(): array
    {

        $query = self::getInstance()->query("SELECT * FROM tb_clientes ORDER BY nome")->fetchAll();

        return $query;

    }
}