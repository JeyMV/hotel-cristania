<?php require './config.php';

require './config.php';
if (!isset($_SESSION["id_cliente"])) {
    return header("location: ./");
}
?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <?php
    $title_page = 'Perfil | Hotel Cristânia';
    require_once './src/includes/layout/header/metas.php';
    ?>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
        }

        .tabs {
            max-width: 100%;
            margin: 0 auto;

        }

        #tab-button {
            display: table;
            table-layout: fixed;
            width: 100%;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #tab-button li {
            display: table-cell;
            width: 20%;
        }

        #tab-button li a {
            display: block;
            padding: .5em;
            background: #eee;
            border: 1px solid #ddd;
            text-align: center;
            color: #000;
            text-decoration: none;
        }

        #tab-button li:not(:first-child) a {
            border-left: none;
        }

        #tab-button li a:hover,
        #tab-button .is-active a {
            border-bottom-color: transparent;
            background: #fff;
        }

        .tab-contents {
            border: 1px solid #ddd;
        }



        .tab-button-outer {
            display: none;
        }

        .tab-contents {
            margin-top: 20px;
        }

        @media screen and (min-width: 768px) {
            .tab-button-outer {
                position: relative;
                z-index: 2;
                display: block;
            }

            .tab-select-outer {
                display: none;
            }

            .tab-contents {
                position: relative;
                top: -1px;
                margin-top: 0;
            }
        }

        .card-text span {
            display: block;
            border-bottom: 1px dotted #444;
            color: orange;
        }

        .card-text span small {
            color: #2a2a2a;
            font-weight: 700;
        }
    </style>
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
        <br /><br />

        <div class="tabs p-0">
            <div class="tab-button-outer">
                <ul id="tab-button">
                    <li><a href="#tab01">Reservas</a></li>
                    <li><a href="#tab02">Dados</a></li>
                    <li><a href="#tab03">Tab 3</a></li>
                    <li><a href="#tab04">Tab 4</a></li>
                    <li><a href="#tab05">Tab 5</a></li>
                </ul>
            </div>
            <div class="tab-select-outer">

                <select id="tab-select" class="form-control">
                    <option value="#tab01">Tab 1</option>
                    <option value="#tab02">Tab 2</option>
                    <option value="#tab03">Tab 3</option>
                    <option value="#tab04">Tab 4</option>
                    <option value="#tab05">Tab 5</option>
                </select>
            </div>

            <div id="tab01" class="tab-contents">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="p-0">
                            <h5 class="card-title">Pedido Nº
                                <?= $reservas['idreserva'] ?>
                            </h5>
                            <hr>
                            <div class="card-text">
                                <span>
                                    Quarto Nº: <small class="float-end">
                                        <?= $reservas['numero'] ?> |
                                        <?= $reservas['designacao_quarto'] ?>
                                    </small>
                                </span>

                                <span>
                                    Status: <small class="float-end">
                                        <?= $reservas['status_reserva'] ?>
                                    </small>
                                </span>

                                <span>
                                    Duração: <small class="float-end">
                                        <?= $reservas['intervalo'] ?> Dias
                                    </small>
                                </span>

                                <span>
                                    Adulto|Criança: <small class="float-end">
                                        <?= $reservas['num_adulto'] ?> |
                                        <?= $reservas['num_crianca'] ?>
                                    </small>
                                </span>

                                <span>
                                    Preço/Noite: <small class="float-end">
                                        <?= $reservas['preco'] ?> Kzs
                                    </small>
                                </span>

                                <span>
                                    Preço/Total: <small class="float-end">
                                        <?= ($reservas['preco'] * $reservas['intervalo']) ?> Kzs
                                    </small>
                                </span>

                                <span>
                                    Data/Entrada: <small class="float-end">
                                        <?= $reservas['data_entrada'] ?>
                                    </small>
                                </span>


                                <span>
                                    Data/Entrada: <small class="float-end">
                                        <?= $reservas['data_saida'] ?>
                                    </small>
                                </span>

                            </div>
                            <div class="mb-3 mt-3 text-center">
                                <a href="#!" class="btn btn-primary w-100">Efetuar Pagamento</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div id="tab02" class="tab-contents">
                <h2>Tab 2</h2>
                <p>html.</p>
            </div>
            <div id="tab03" class="tab-contents">
                <h2>Tab 3</h2>
                <p>CSS.</p>
            </div>
            <div id="tab04" class="tab-contents">
                <h2>Tab 4</h2>
                <p>JS.</p>
            </div>
            <div id="tab05" class="tab-contents">
                <h2>Tab 5</h2>
                <p>SQL.</p>
            </div>
        </div>


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
    <script>
        $(function () {
            var $tabButtonItem = $('#tab-button li'),
                $tabSelect = $('#tab-select'),
                $tabContents = $('.tab-contents'),
                activeClass = 'is-active';

            $tabButtonItem.first().addClass(activeClass);
            $tabContents.not(':first').hide();

            $tabButtonItem.find('a').on('click', function (e) {
                var target = $(this).attr('href');

                $tabButtonItem.removeClass(activeClass);
                $(this).parent().addClass(activeClass);
                $tabSelect.val(target);
                $tabContents.hide();
                $(target).show();
                e.preventDefault();
            });

            $tabSelect.on('change', function () {
                var target = $(this).val(),
                    targetSelectNum = $(this).prop('selectedIndex');

                $tabButtonItem.removeClass(activeClass);
                $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
                $tabContents.hide();
                $(target).show();
            });
        });
    </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>