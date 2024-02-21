<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">CLIENTES</h3>
                    <!-- Table with stripped rows -->
                    <table class="table table-striped table-sm datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>
                                    Nome
                                </th>
                                <th>Nº B.I</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Data / Registo</th>
                                <th>Avaliação/Comportamento</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td>
                                        <?= $cliente->id_cliente ?>
                                    </td>
                                    <td>
                                        <?= $cliente->nome ?>
                                    </td>
                                    <td>
                                        <?= $cliente->numero_bi ?>
                                    </td>
                                    <td>
                                        <?= $cliente->telefone ?>
                                    </td>
                                    <td>
                                        <?= $cliente->email ?>
                                    </td>
                                    <td>
                                        <?= $cliente->created_at ?>
                                    </td>
                                    <td>Bom</td>
                                    <td>----</td>
                                <?php endforeach ?>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>
</section>