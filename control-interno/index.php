<?php
session_start();
require_once("../vendor/autoload.php");

if (!isset($_SESSION["id_funcionario"])) {
  return header("location: ./pages-login.php");
}

use \App\Model\Cargos;
use App\Model\Clientes;
use \App\Model\Quartos;
use App\Model\Reservas;
use \App\Model\TipoQuartos;
use \App\Model\Funcionarios;

$dados_funcionario = Funcionarios::show($_SESSION["id_funcionario"]);
$cargos_funcionarios = Cargos::getAll();
$funcionarios = Funcionarios::index();
$tipo_quartos = TipoQuartos::getAll();
$quartos = Quartos::getAllQuartos();
$clientes = Clientes::getAll();
$reservas = Reservas::getAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistema de Gestão de Hotel Cristânia</title>
  <meta content="Sistema de Gerenciamento para Hotel Cristânia" name="description">
  <meta content="Hotel, Cristânia, Luanda, Camama" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/sweet.css">
</head>

<body>

  <!-- ======= Header ======= -->
  <?php require './layouts/header.php'; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php require './layouts/sidebar.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <?php
    if (isset($_GET['page'])) {

      $page = filter_input(INPUT_GET, 'page');

      if (file_exists('./view/' . $page . '.php')) {

        $page = './view/' . $page . '.php';

        require $page;

      } else {

      }

    } else {

      require_once './view/index.php';

    }
    ?>

  </main>
  <!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="./assets/js/sweet.js"></script>
  <script src="../js/ajax.js"></script>

  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>

</body>

</html>