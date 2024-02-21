<?php

require_once './vendor/autoload.php';

use \App\Model\Auth;
use App\Model\Clientes;
use App\Model\Funcionarios;
use App\Model\Pagamentos;
use App\Model\Quartos;
use App\Model\Reservas;

if (isset($_POST["acao"]) && $_POST["acao"] != "") {

    $acao = htmlspecialchars($_POST["acao"]);
    $tabela = htmlspecialchars(filter_input(INPUT_POST, "tabela"));

    $nome = htmlspecialchars(filter_input(INPUT_POST, "nome"));
    $email = htmlspecialchars(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $password = htmlspecialchars(filter_input(INPUT_POST, "password"));
    $number_pass = htmlspecialchars(filter_input(INPUT_POST, 'numero_funcionario'));
    $number_BI = htmlspecialchars(filter_input(INPUT_POST, 'numero_bi'));
    $number_phone = htmlspecialchars(filter_input(INPUT_POST, 'telefone'));
    $id_cargo = htmlspecialchars(filter_input(INPUT_POST, 'id_cargo', FILTER_SANITIZE_NUMBER_INT));
    $endereco = htmlspecialchars(filter_input(INPUT_POST, 'endereco'));
    $tipo_quarto = htmlspecialchars(filter_input(INPUT_POST, 'id_tipo_quarto', FILTER_SANITIZE_NUMBER_INT));
    $numero_quarto = htmlspecialchars(filter_input(INPUT_POST, 'numero_quarto', FILTER_SANITIZE_NUMBER_INT));
    $numero_cama = htmlspecialchars(filter_input(INPUT_POST, 'numero_cama', FILTER_SANITIZE_NUMBER_INT));
    $numero_banheiro = htmlspecialchars(filter_input(INPUT_POST, 'numero_banheiro', FILTER_SANITIZE_NUMBER_INT));
    $preco_quarto = htmlspecialchars(filter_input(INPUT_POST, 'preco_quarto', FILTER_SANITIZE_NUMBER_FLOAT));
    $id_funcionario = htmlspecialchars(filter_input(INPUT_POST, 'id_funcionario', FILTER_SANITIZE_NUMBER_INT));
    $id_cliente = htmlspecialchars(filter_input(INPUT_POST, 'id_cliente', FILTER_SANITIZE_NUMBER_INT));
    $comment = nl2br(htmlspecialchars(filter_input(INPUT_POST, 'comment')));
    $check_in = filter_input(INPUT_POST, 'check_in');
    $check_out = filter_input(INPUT_POST, 'check_out');
    $num_adulto = htmlspecialchars(filter_input(INPUT_POST, 'num_adulto', FILTER_SANITIZE_NUMBER_INT));
    $id_quarto = filter_input(INPUT_POST, 'id_quarto', FILTER_SANITIZE_NUMBER_INT);
    $num_crianca = htmlspecialchars(filter_input(INPUT_POST, 'num_crianca', FILTER_SANITIZE_NUMBER_INT));
    $id_modo_pagamento = htmlspecialchars(filter_input(INPUT_POST, 'metodo_pagamento'));
    $comprovativo = $_FILES['comprovativo'];
    $valor_pagamento = htmlspecialchars(filter_input(INPUT_POST, 'valor_pagamento'));

    switch ($acao) {
        case "auth-login":

            print json_encode(Auth::login($email, $password, $tabela));
            break;

        case "registar-funcionario":

            print json_encode(Funcionarios::register($nome, $number_phone, $endereco, $id_cargo, $email, $number_pass, $password));

            break;

        case "adicionar-quarto":

            print json_encode(Quartos::register($tipo_quarto, $id_funcionario, $numero_quarto, $numero_cama, $numero_banheiro, $preco_quarto));

            break;

        case "registar-cliente":

            print json_encode(Clientes::register($nome, $number_BI, $number_phone, $email, $password));

            break;

        case "solicitar-reserva":

            print json_encode(Reservas::register($id_cliente, $id_quarto, $num_adulto, $num_crianca, $check_in, $check_out, $comment));

            break;

        case "efetuar-pagamento":

            print json_encode(Pagamentos::store($id_cliente, $id_quarto, $id_modo_pagamento, $valor_pagamento, $comprovativo));

            break;

    }
}