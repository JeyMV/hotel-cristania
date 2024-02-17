<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Pedidos/Reservas</h3>
                    <!-- Table with stripped rows -->
                    <table class="table table-striped table-sm datatable">
                        <thead>
                            <tr>
                                <th>
                                    Cliente
                                </th>
                                <th>Quarto</th>
                                <th>Tipo/Quarto</th>
                                <th>Preço/Noite</th>
                                <th>Nº/Adultos</th>
                                <th>Nº/Criança</th>
                                <th>Data/Entrada</th>
                                <th>Data/Saída</th>
                                <th>Duração</th>
                                <th>Status</th>
                                <th>Pagamento</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Data/Registo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $class = 'text-primary';
                            foreach ($reservas as $pedido):
                                if ($pedido->status_reserva == 'Cancelado') {
                                    $class = 'text-danger';
                                } elseif ($pedido->status_reserva == 'Aprovado') {
                                    $class = 'text-success';
                                }
                                ?>
                                <tr>
                                    <td>
                                        <?= $pedido->nome ?>
                                    </td>
                                    <td>
                                        <?= $pedido->numero ?>
                                    </td>
                                    <td>
                                        <?= $pedido->designacao_quarto ?>
                                    </td>
                                    <td>
                                        <?= $pedido->preco ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-center">
                                            <?= $pedido->num_adulto ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary text-center">
                                            <?= $pedido->num_crianca ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= explode(" ", $pedido->data_entrada)[0] ?>
                                    </td>
                                    <td>
                                        <?= explode(" ", $pedido->data_saida)[0] ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill bg-dark">
                                            <?= $pedido->intervalo ?> Dias
                                        </span>

                                    </td>
                                    <td>
                                        <span class="<?= $class ?>">
                                            <b>
                                                <?= $pedido->status_reserva ?>
                                            </b>
                                        </span>

                                    </td>
                                    <td>
                                        <span class="text-dark">
                                            <b>
                                                <?= $pedido->status_pagamento ?>
                                            </b>
                                        </span>
                                    </td>
                                    <td>
                                        <?= explode(" ", $pedido->created_at)[0] ?>
                                    </td>
                                    <td>
                                        <b>
                                            <a href="#!" class="text-danger bi bi-trash-fill" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Remover a solicitação!"></a>
                                            <a href="#!" class="text-dark bi bi-ban" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Cancelar a solicitação!"></a>
                                            <a href="#!" class="text-success bi bi-clipboard-check-fill"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Aprovar a solicitação!"></a>
                                        </b>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>
</section>