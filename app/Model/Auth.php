<?php
namespace App\Model;

use App\Drive\Conexao;

class Auth
{
    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function validar($email)
    {
        $erro = "";

        $patternEmail = '/^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';
        if (!preg_match($patternEmail, $email)) { // verifica email
            $erro = 'E-mail inválido ';
        }

        // check mais

        $check = static::getInstance()->query("SELECT *FROM validadores WHERE validadorEmail = '$email'");
        if ($check->rowCount() > 0) {
            $erro = "Validador já cadastrado.";
        }

        return $erro;
    }

    /* Fazer login administrador no sistema */
    public static function login($email, $password, $tabela)
    {

        $selectEmail = self::getInstance()->query("SELECT email FROM {$tabela} WHERE email = '" . $email . "'");

        if ($selectEmail->rowCount() > 0) {

            $selectPassordHash = self::getInstance()->query("SELECT password FROM {$tabela} WHERE email = '" . $email . "'")->fetch()->password;

            if (password_verify($password, $selectPassordHash)) {

                $data = self::getInstance()->query("SELECT *FROM {$tabela} WHERE email = '$email' AND password = '$selectPassordHash'");

                if ($data->rowCount() > 0) {

                    session_start();

                    if ($tabela === 'tb_auth') {

                        $_SESSION['id_funcionario'] = $data->fetch()->id_funcionario;

                    }

                    $_SESSION['id_cliente'] = $data->fetch()->id_cliente;

                    http_response_code(200);
                    return ['status' => '200', 'msg' => 'Sucesso. Aguarde...'];

                } else {

                    http_response_code(401);
                    return ['status' => '401', 'msg' => 'Verifique se os seus dados estão corretos', 'data' => $_POST];
                }

            } else {

                http_response_code(401);
                return ['status' => '401', 'msg' => 'palavra-passe incorreta'];
            }
        } else {

            http_response_code(401);
            return ['status' => '401', 'msg' => 'E-mail inexistente'];

        }
    }

    /* Fazer login validador no sistema */
    public static function loginValidador($email, $password)
    {

        $selectEmail = self::getInstance()->query("SELECT validadorEmail FROM validadores WHERE validadorEmail = '" . $email . "'");
        if ($selectEmail->rowCount() > 0) {

            //  $selectPassord = self::getInstance()->query("SELECT password FROM administradors WHERE email = '" . $email . "'")->fetch()->password;
            $selectPassordHash = self::getInstance()->query("SELECT validadorSenha FROM validadores WHERE validadorEmail = '" . $email . "'")->fetch()->validadorSenha;

            // VERICA A SENHA SEGURA

            if (password_verify($password, $selectPassordHash)) {
                $data = self::getInstance()->query("SELECT * FROM validadores WHERE validadorEmail = '$email' AND validadorSenha = '$selectPassordHash'");

                if ($data->rowCount() > 0) {
                    session_start();
                    $_SESSION['idValidador'] = $data->fetch()->idvalidadores;

                    return ['status' => 'success', 'msg' => 'Sucesso. Aguarde...'];
                } else {

                    http_response_code(401);
                    return ['status' => '401', 'msg' => 'Verifique se os seus dados estão corretos', 'data' => $_POST];
                }
            } else {

                http_response_code(401);
                return ['status' => '401', 'msg' => 'palavra-passe incorreta.'];
            }
        } else {

            http_response_code(401);
            return ['status' => '401', 'msg' => 'E-mail inexistente'];
        }
    }
}