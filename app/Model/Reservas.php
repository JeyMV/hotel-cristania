<?php
namespace App\Model;

use PDO;
use DateTime;
use PDOException;
use App\Drive\Conexao;

class Reservas
{
    private static $conexao;

    public static function getInstance()
    {

        if (self::$conexao === null) {
            self::$conexao = Conexao::ligar();
        }

        return self::$conexao;
    }

    public static function register($id_cliente, $id_quarto, $num_adulto, $num_crianca, $check_in, $check_out, $comment): array
    {

        $erro = '';

        try {
            $store = self::getInstance()->prepare("INSERT INTO tb_reservas(id_cliente, id_quarto, num_adulto, num_crianca, data_entrada, data_saida, intervalo, comentario)
             VALUES(?,?,?,?,?,?,?,?)");

            // Obtém a data atual
            $currentDate = date("Y-m-d H:i:s");

            // Converte as datas para objetos DateTime
            $checkInDate = new DateTime($check_in);
            $checkOutDate = new DateTime($check_out);

            // Calcula a diferença entre as datas
            $interval = $checkInDate->diff($checkOutDate);

            // Obtém o intervalo em dias
            $intervalDays = $interval->days;

            $store->bindValue(1, $id_cliente, PDO::PARAM_INT);
            $store->bindValue(2, $id_quarto, PDO::PARAM_INT);
            $store->bindValue(3, $num_adulto, PDO::PARAM_INT);
            $store->bindValue(4, $num_crianca, PDO::PARAM_INT);
            $store->bindValue(5, $check_in, PDO::PARAM_STR);
            $store->bindValue(6, $check_out, PDO::PARAM_STR);
            $store->bindValue(7, $intervalDays, PDO::PARAM_STR);
            $store->bindValue(8, $comment, PDO::PARAM_STR);

            $cheReserva = self::getInstance()->query("SELECT *FROM tb_reservas WHERE id_cliente = '$id_cliente' AND status_reserva = 'Solicitado'");

            if ($cheReserva->rowCount() > 0) {

                $erro = 'Verificamos que já solicitou uma reserva.';
            }

            // Compara as datas
            if ($checkInDate < new DateTime($currentDate) || $checkOutDate < new DateTime($currentDate)) {
                // As datas selecionadas são inválidas (passadas)
                $erro = "Você não pode selecionar uma data passada.";
            }

            if ($checkInDate > $checkOutDate) {
                // As datas selecionadas são inválidas (passadas)
                $erro = "Data de entrada deve ser inferior a data de saída!";
            }

            if ($erro == '') {
                if ($store->execute()) {

                    http_response_code(200);
                    return ["status" => 200, "msg" => "Pedido de Reserva Efetuada com Sucesso!"];
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

    public static function getAll(): array
    {

        $reservas = self::getInstance()->query("SELECT * FROM tb_reservas AS TR
        INNER JOIN tb_clientes AS TC ON TC.id_cliente = TR.id_cliente
        INNER JOIN tb_quarto AS TQ ON TQ.idquarto = TR.id_quarto
        INNER JOIN tb_tipo_quarto AS TTQ ON TTQ.idtipoquarto = TQ.id_tipo_quarto
        ");

        return $reservas->fetchAll();
    }

    public static function getWithClient($id_cliente): array
    {

        $reservas = self::getInstance()->query("SELECT * FROM tb_reservas AS TR
        INNER JOIN tb_clientes AS TC ON TC.id_cliente = TR.id_cliente
        INNER JOIN tb_quarto AS TQ ON TQ.idquarto = TR.id_quarto
        INNER JOIN tb_tipo_quarto AS TTQ ON TTQ.idtipoquarto = TQ.id_tipo_quarto
       WHERE TR.id_cliente = '$id_cliente';
        ");

        return $reservas->fetch(PDO::FETCH_ASSOC);
    }
}