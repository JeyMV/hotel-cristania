<?php
namespace App\Model;

use PDO;
use PDOException;
use App\Drive\Conexao;

class Pagamentos
{
    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function store($id_cliente, $id_quarto, $id_modo_pagamento, $valor_pagamento, $comprovativo): array
    {
        try {

            $erro = '';
            $file_comprovativo = '';

            $store = self::getInstance()->prepare("INSERT INTO tb_pagamentos (id_cliente, id_quarto, id_modo_pagamento, valor_pagemnto, status_pagamento, comprovativo)
           VALUES(,?,?,?,?,?)");

            $arquivo = array(
                'arquivo' => $comprovativo['name'],
                'temporal' => $comprovativo['tmp_name'],
                'tipo' => strtolower($comprovativo['type']),
                'formato' => strtolower(pathinfo($comprovativo['name'], PATHINFO_EXTENSION)),
                'nome' => time() . '.' . strtolower(pathinfo($comprovativo['name'], PATHINFO_EXTENSION)),
                'diretorio' => 'storage/comprovativos/'
            );

            $formatos_permitidos = array('pdf', 'png', 'jpg', 'jpeg');

            # =========================== VERIFICA OS FORMATOS PERMITIDOS =====================
            if (in_array($arquivo['formato'], $formatos_permitidos)) {

                # ========================= VERIFICA O DIRECTORIO =====================
                if (!is_dir(dirname($arquivo['diretorio']))) {
                    mkdir(dirname($arquivo['diretorio']), 0777, true);
                }

                if (!is_dir($arquivo['diretorio'])) {
                    mkdir($arquivo['diretorio'], 0777, true);
                }

                if (is_dir($arquivo['diretorio'])) {
                    # ===================================== TENTA O UPLOAD ==================
                    if (move_uploaded_file($arquivo['temporal'], $arquivo['diretorio'] . $arquivo['nome'])) {
                        $comprovativo_path = $arquivo['nome'];
                    } else {
                        $erro = 'Falha no upload.' . $arquivo['diretorio'] . $arquivo['nome'];
                    }
                }

            } else {

                $comprovativo_path = null;
                $erro = 'Formato .' . $arquivo['formato'] . ' não é permitido';

            }

            $store->bindValue(1, $id_cliente, PDO::PARAM_INT);
            $store->bindValue(2, $id_quarto, PDO::PARAM_INT);
            $store->bindValue(3, $id_modo_pagamento, PDO::PARAM_INT);
            $store->bindValue(4, $valor_pagamento, PDO::PARAM_STR);
            $store->bindValue(5, $arquivo['diretorio'] . $comprovativo_path, PDO::PARAM_STR);

            if ($erro == '') {
                if ($store->execute()) {
                    http_response_code(200);
                    return ['status' => 200, 'msg' => 'Sucesso! O seu pagamento foi recebido e esta a ser analizado. Obrigado'];
                }
                http_response_code(401);
                return ['status' => 401, 'msg' => $store->errorInfo()];

            }

            http_response_code(401);
            return ['status' => 401, 'msg' => $erro];

        } catch (PDOException $th) {
            http_response_code(401);
            return ['status' => 401, 'msg' => 'ERROR: ' . $th->getMessage(), 'code' => $th->getCode()];
        }
    }

    public static function getAll(): array
    {
        $pagamentos = self::getInstance()->query("SELECT *FROM tb_pagamentos");

        return $pagamentos->fetchAll();
    }

}