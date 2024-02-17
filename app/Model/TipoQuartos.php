<?php
namespace App\Model;

use App\Drive\Conexao;

class TipoQuartos
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
        $tipo_quarto = self::getInstance()->query("SELECT *FROM tb_tipo_quarto");

        return $tipo_quarto->fetchAll();
    }

}