<?php
namespace App\Model;

use App\Drive\Conexao;

class Cargos
{
    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function getAll(): array
    {
        $cargos = self::getInstance()->query("SELECT *FROM tb_cargos");

        return $cargos->fetchAll();
    }

}