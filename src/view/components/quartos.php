<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Quartos</h6>
            <h1 class="mb-5">Veja Nossos <span class="text-primary text-uppercase"> Quartos</span></h1>
        </div>
        <div class="row g-4">
            <?php foreach ($quartos as $quarto): ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="img-fluid" src="img/room-1.jpg" alt="">
                            <small
                                class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">Kz.
                                <?= number_format($quarto->preco, 2, ',', '.') ?>/Noite
                            </small>
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">
                                    <?= $quarto->designacao_quarto ?>
                                </h5>
                                <div class="ps-2">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>
                                    <?= $quarto->numero_cama ?>
                                    <?= ($quarto->numero_cama > 1) ? 'Camas' : 'Cama' ?>
                                </small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>
                                    <?= $quarto->numero_banheiro ?>
                                    <?= ($quarto->numero_banheiro > 1) ? 'Banheiros' : 'Banheiro' ?>
                                </small>
                                <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                            </div>
                            <p class="text-body mb-3">Erat ipsum justo amet duo et elitr dolor, est duo duo eos
                                lorem sed diam stet diam sed stet lorem.</p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4" href="">Mais Detalhes</a>
                                <?php
                                if ($quarto->status == 'ocupado'): ?>
                                    <a class="btn btn-sm btn-danger rounded py-2 px-4" href="#!">quarto ocupado</a>
                                <?php else: ?>
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="#!">Reservar agora</a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>