<?php
session_start();
require './vendor/autoload.php';

use App\Model\Clientes;
use App\Model\Quartos;
use App\Model\Reservas;

$cliente = "";
$reservas = "";
if (isset($_SESSION['id_cliente'])) {
    $cliente = Clientes::show($_SESSION['id_cliente']);
    $reservas = Reservas::getWithClient($_SESSION["id_cliente"]);
}

$quarto_3 = Quartos::getTreeRoom();
$quartos = Quartos::getAllQuartos();

define('URL', 'http://' . $_SERVER['SERVER_NAME'] . '/hotel-cristania');
define('IMAGES', URL . '/storage/images/');
define('CSS', URL . '/public/css/');
define('JS', URL . '/public/js/');
define('BOOTSTRAP_CSS', URL . '/plugins/bootstrap/css/bootstrap.min.css');
define('BOOTSTRAP_JS_BUNDLE', URL . '/plugins/bootstrap/js/bootstrap.bundle.min.js');
define('BOOTSTRAP_JS', URL . '/plugins/bootstrap/js/bootstrap.min.js');
