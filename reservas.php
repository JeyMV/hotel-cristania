<?php require './config.php';
if (!isset($_SESSION["id_cliente"])) {
    return header("location: ./");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    $title_page = 'Reservas | Hotel Cristânia';
    require_once './src/includes/layout/header/metas.php';
    ?>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <?php require './src/includes/layout/header/menu.php'; ?>
        <!-- Header End -->


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Reservas</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Reservas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Booking Start -->
        <?php include './src/view/components/reservas.php'; ?>
        <!-- Booking End -->


        <!-- Booking Start Form-->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Rerversa de Quarto</h6>
                    <h1 class="mb-5">Solicite um <span class="text-primary text-uppercase">Quarto Luxuoso</span></h1>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s"
                                    src="img/about-1.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                    src="img/about-2.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s"
                                    src="img/about-3.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s"
                                    src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form class="form-post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" value="<?=$cliente['nome']?>"
                                                disabled readonly>
                                            <label for="name">Nome completo</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email"
                                               value="<?= $cliente['email'] ?>" readonly disabled>
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date3" data-target-input="nearest">
                                            <input type="datatime" name="check_in" class="form-control datetimepicker-input"
                                                id="checkin" placeholder="Data de entrada" data-target="#date3"
                                                data-toggle="datetimepicker" required />
                                            <label for="checkin">Data/Hora - Entrada</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date" id="date4" data-target-input="nearest">
                                            <input type="datatime" name="check_out"
                                                class="form-control datetimepicker-input" id="checkout"
                                                placeholder="Data de saída" data-target="#date4"
                                                data-toggle="datetimepicker" />
                                            <label for="checkout">Data/Hora - Saída</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="num_adulto" id="select1">
                                                <option value="1">1</option>
                                                <option value="2">2 </option>
                                                <option value="3">3</option>
                                            </select>
                                            <label for="select1">Quantos adultos?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select" name="num_crianca" id="select2">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                            <label for="select2">Quantas crianças?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-floating">
                                            <select class="form-select" name="id_quarto" id="select3">
                                                <?php foreach ($quartos as $quarto):
                                                    if ($quarto->status != 'ocupado'): ?>
                                                        <option value="<?= $quarto->idquarto ?>">
                                                            Quarto
                                                            <?= $quarto->numero ?> -
                                                            <?= $quarto->designacao_quarto ?> |
                                                            <?= number_format($quarto->preco, 2, ',', '.') ?> Kz/Noite
                                                        </option>
                                                        <?php
                                                    endif;
                                                endforeach
                                                ?>
                                            </select>
                                            <label for="select3">Escolha um Quanto</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="comment" placeholder="Special Request" id="message"
                                                style="height: 100px" required></textarea>
                                            <label for="message">Deixe um comentário sobre a sua solicitação e pedido de
                                                reserva de quarto.</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Reservar Agora</button>
                                    </div>
                                </div>
                                <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
                                <input type="hidden" name="acao" value="solicitar-reserva">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking From End -->


        <!-- Newsletter Start -->
        <?php include './src/view/components/newlatter.php'; ?>
        <!-- Newsletter Start -->


        <!-- Footer Start -->
        <?php require './src/includes/layout/footer/footer.php'; ?>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="./control-interno/assets/js/sweet.js"></script>
  <script>
    $(function () {
    $('#date3, #date4').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        icons: {
            time: 'far fa-clock',
            date: 'far fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check',
            clear: 'far fa-trash-alt',
            close: 'far fa-times-circle'
        }
    });
});

  </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="./js/ajax.js"></script>
</body>

</html>