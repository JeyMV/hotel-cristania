<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="float-end">
                            <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                data-bs-target="#modalNovoFuncionario"><i class="bi bi-plus-circle me-1"></i> Adicionar
                            </button>
                        </div>
                        <h5>Quartos</h5>

                    </div>
                    <!-- Table with stripped rows -->
                </div>
            </div>

            <div class="card">
                <div class="card-body p-2">
                    <table class="table table-sm table-striped table-light datatable table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nº do Quarto</th>
                                <th>Tipo de Quarto</th>
                                <th>Nº/Camas</th>
                                <th>Nº/Banheiros</th>
                                <th>Preço/Noite</th>
                                <th>Status</th>
                                <th>Adicionado por</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Data / Registo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($quartos as $quarto): ?>
                                <tr>
                                    <td>
                                        <?= $quarto->idquarto ?>
                                    </td>
                                    <td>
                                        <?= $quarto->numero ?>
                                    </td>
                                    <td>
                                        <?= $quarto->designacao_quarto ?>
                                    </td>
                                    <td>
                                        <?= $quarto->numero_cama ?>
                                    </td>
                                    <td>
                                        <?= $quarto->numero_banheiro ?>
                                    </td>
                                    <td>
                                        <?= number_format($quarto->preco, 2, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?=
                                            $quarto->status == 'disponível' ? '<span class="badge bg-success badge-fill">Disponível</span>' : '<span class="badge bg-danger badge-fill">Ocupado</span>'
                                            ?>
                                    </td>
                                    <td>
                                        <?= $quarto->nome ?>
                                    </td>
                                    <td>
                                        <?= $quarto->created_at ?>
                                    </td>
                                    <td>
                                        <a href="#!" class="bi bi-pencil-fill text-dark"></a>
                                        <a href="#!" class="bi bi-trash-fill text-danger"></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

<div class="modal fade" id="modalNovoFuncionario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Adicionar Novo Quarto</h3>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="row g-3 form-post">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="numero_quarto" class="form-control form-control-lg"
                                id="floatQuarto" placeholder="Número da Porta do Quarto" min="1" max="26" required>
                            <label for="floatQuarto">Número do Quarto *</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" name="id_tipo_quarto" id="formTipo">
                                <option>Selecione o tipo</option>
                                <?php foreach ($tipo_quartos as $tipo): ?>
                                    <option value="<?= $tipo->idtipoquarto ?>">
                                        <?= $tipo->designacao_quarto ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                            <label for="formTipo">Tipo de Quarto *</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="numero_cama" class="form-control form-control-lg" id="floatCama"
                                placeholder="Números de Cama no Quarto" min="1" max="3" required>
                            <label for="floatCama">Números de Camas *</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="numero_banheiro" class="form-control form-control-lg"
                                id="floatBanheiro" placeholder="Números de Banhero no Quarto" min="1" max="2" required>
                            <label for="floatBanheiro">Números de Banhiros *</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="preco_quarto" class="form-control form-control-lg"
                                id="floatingPreco" placeholder="Preço para Hospedagem" required>
                            <label for="floatingPreco">Preço/Noite *</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-5 w-50">Adicionar</button>
                    </div>
                    <input type="hidden" name="acao" value="adicionar-quarto">
                    <input type="hidden" name="id_funcionario" value="<?= $_SESSION["id_funcionario"] ?>">
                </form><!-- End floating Labels Form -->
            </div>
        </div>
    </div>
</div><!-- End Large Modal-->