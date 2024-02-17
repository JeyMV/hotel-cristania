<?php
namespace App\Model;

use App\Drive\Conexao;
use PDOException;

class Quartos
{
    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function register($id_tipo_quarto, $id_funcionario, $numero_quarto, $numero_cama, $numero_banheiro, $preco_quarto): array
    {
        try {

            $erro = '';

            $store = self::getInstance()->prepare("INSERT INTO tb_quarto (id_funcionarios, id_tipo_quarto, numero_cama, numero_banheiro, numero, preco)
            VALUES(?,?,?,?,?,?) ");

            $store->bindValue(1, $id_funcionario);
            $store->bindValue(2, $id_tipo_quarto);
            $store->bindValue(3, $numero_cama);
            $store->bindValue(4, $numero_banheiro);
            $store->bindValue(5, $numero_quarto);
            $store->bindValue(6, $preco_quarto);

            $checkQuarto = self::getInstance()->query("SELECT * FROM tb_quarto WHERE numero = '$numero_quarto'");

            if ($checkQuarto->rowCount() > 0) {
                $erro = 'O Quarto número ' . $numero_quarto . ' já existe';
            }


            if ($erro == '') {
                if ($store->execute()) {
                    http_response_code(200);
                    return ['status' => 200, 'msg' => 'Quarto cadastrado com sucesso'];
                } else {

                    http_response_code(401);
                    return ['status' => 401, 'msg' => $store->errorInfo()];
                }
            }

            http_response_code(401);
            return ['status' => 401, 'msg' => $erro];


        } catch (PDOException $th) {
            http_response_code(401);
            return ['status' => 401, 'msg' => $th->getMessage()];
        }

    }

    public static function getAllQuartos(): object
    {
        return self::getInstance()->query("SELECT *FROM tb_quarto AS TQ 
        INNER JOIN tb_tipo_quarto AS TT ON TQ.id_tipo_quarto = TT.idtipoquarto
        INNER JOIN tb_funcionarios AS TF ON TQ.id_funcionarios = TF.idfuncionario");
    }

    public static function getTreeRoom(): object
    {
        return self::getInstance()->query("SELECT *FROM tb_quarto AS TQ 
        INNER JOIN tb_tipo_quarto AS TT ON TQ.id_tipo_quarto = TT.idtipoquarto
        LIMIT 0,3");

    }

}