<?php
namespace App\Drive;

use PDO;
use PDOException;

class Conexao
{
    private static $username, $servername, $password, $ligar; // pega os requisitos para a conexão

    public static function ligar()
    {
        try {

            //atribui ou guardar as credecnias ndo banco numa variavel
            self::$username = 'root'; 
            self::$servername = 'localhost';
            self::$password = ''; 
            // tenta realizar a conexão
            self::$ligar = new PDO("mysql:host=" . self::$servername . ";dbname=hotel_cristania", self::$username, self::$password);
            self::$ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            self::$ligar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            self::$ligar->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return self::$ligar;
            //echo "Sucesso na conexão";
        } catch (PDOException $e) {
            echo json_encode("Erro na conexão: " . $e->getMessage(), JSON_ERROR_UTF8);
            // falha de conexão
        }
    }
}