<div class="container-fluid bg-dark px-0">
    <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
            <a href="./index.php"
                class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <h1 class="m-0 text-primary text-uppercase">HCR</h1>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row gx-0 bg-white d-none d-lg-flex">
                <div class="col-lg-7 px-5 text-start">
                    <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                        <i class="fa fa-envelope text-primary me-2"></i>
                        <p class="mb-0">info@example.com</p>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2">
                        <i class="fa fa-phone-alt text-primary me-2"></i>
                        <p class="mb-0">+244 923 456 789</p>
                    </div>
                </div>
                <div class="col-lg-5 px-5 text-end">
                    <div class="d-inline-flex align-items-center py-2">
                        <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                        <a class="" href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 text-primary text-uppercase">HCR</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="./" class="nav-item nav-link">Home</a>
                        <a href="./sobre.php" class="nav-item nav-link">Sobre</a>
                        <a href="./service.php" class="nav-item nav-link">Serviços</a>
                        <a href="./quartos.php" class="nav-item nav-link">Quartos</a>
                        <a href="contact.php" class="nav-item nav-link">Contactos</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Mais</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="reservas.php" class="dropdown-item">Reservas</a>
                                <a href="team.php" class="dropdown-item">Nossa equipe</a>
                                <a href="testimonial.php" class="dropdown-item">Testemunhos</a>
                                <a href="sair.php" class="dropdown-item">Terminar sessão</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    session_start();
                    if (!isset($_SESSION["id_cliente"])): ?>
                        <a href="<?= URL ?>/control-interno/pages-login-cliente.php"
                            class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Login /
                            Registo<i class="fa fa-arrow-right ms-3"></i></a>
                    <?php else: ?>
                        <a href="<?= URL ?>/perfil.php" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">
                            <?= explode(" ", $cliente['nome'])[0] ?>
                            <i class="fa fa-arrow-right ms-3"></i>
                        </a>
                    <?php endif ?>

                </div>
            </nav>
        </div>
    </div>
</div>