<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="float-end">
                            <button type="button" class="btn btn-primary rounded-5" data-bs-toggle="modal"
                                data-bs-target="#modalNovoFuncionario"><i class="bi bi-plus-circle me-1"></i> Novo
                            </button>
                        </div>
                        <h5>FUNCIONÁRIOS</h5>

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
                                <th>Nº Passe</th>
                                <th>
                                    Nome
                                </th>
                                <th>Cargo</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Província</th>
                                <th>Bairo / Rua</th>
                                <th data-type="date" data-format="YYYY/DD/MM">Data / Registo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($funcionarios as $fn): ?>
                                <tr>
                                    <td>
                                        <?= $fn->idfuncionario ?>
                                    </td>
                                    <td>
                                        <?= $fn->numero_funcionario ?>
                                    </td>
                                    <td>
                                        <span style="text-transform: capitalize !important;">
                                            <?= ucfirst($fn->nome) ?>
                                        </span>

                                    </td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-primary">
                                            <?= $fn->cargo_designacao ?>
                                        </span>

                                    </td>
                                    <td>
                                        <?= $fn->telefone ?>
                                    </td>
                                    <td>
                                        <?= $fn->email ?>
                                    </td>
                                    <td>
                                        <?= $fn->provincia ?>
                                    </td>
                                    <td>
                                        <?= $fn->rua ?>
                                    </td>
                                    <td>
                                        <?= $fn->created_at ?>
                                    </td>
                                    <td>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-light">Registar Funcionário</h3>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="row g-3 form-post">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="numero_bi" class="form-control form-control-lg" id="floatBI"
                                placeholder="Número de BI">
                            <label for="floatBI">Número de Bilhete de Identidade</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="nome" class="form-control form-control-lg" id="floatName"
                                placeholder="Seu nome completo" required readonly>
                            <label for="floatName">Nome Completo</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-tfloating">
                            <select class="form-select" name="id_cargo" id="formId">
                                <option selected value="0">Selecione o cargo</option>
                                <?php foreach ($cargos_funcionarios as $cargo): ?>
                                    <option value="<?= $cargo->idcargo ?>">
                                        <?= $cargo->cargo_designacao ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                            <label for="formId">Cargo do Funcionário</label>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="numero_funcionario" class="form-control form-control-lg"
                                id="floatID" placeholder="ID do Funcionário" required>
                            <label for="floatID">Número do Pass</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control form-control-lg" id="floatingEmail"
                                placeholder="usuario@provedor.com" required>
                            <label for="floatingEmail">E-mail</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="tel" name="telefone" class="form-control form-control-lg" id="floatingTelefone"
                                placeholder="923 456 789" value="">
                            <label for="floatingTelefone">Nº de Telefone</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" name="endereco" class="form-control form-control-lg"
                                id="floatingProvincia" placeholder="Sua Província" required readonly>
                            <label for="floatingProvincia">Endereço (Província, Bairro e Rua)</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-5 w-50">Registar</button>
                    </div>
                    <input type="hidden" name="acao" value="registar-funcionario">
                </form><!-- End floating Labels Form -->
            </div>
        </div>
    </div>
</div><!-- End Large Modal-->

<script>
    function responseSweet(msg, type, title) {
        Swal.fire({
            icon: type,
            title: title,
            text: msg,
            timerProgressBar: true,
            timer: 5000,
            showConfirmButton: false,
            customClass: {
                progressBar: "progress-bar-custore", // Aplica a classe CSS personalizada à barra de progresso
            },
        });
    }
    let BI = document.querySelector('#floatBI')

    BI.addEventListener('blur', () => {
        fetch(`https://bi.minjusdh.gov.ao/api/identityLostService/identitycardlost/queryRegisterInfo/${BI.value}`)
            .then(res => res.json())
            .then(datas => {
                if (datas.data.FIRST_NAME) {

                    document.querySelector('#floatName').value = `${datas.data.FIRST_NAME}  ${datas.data.LAST_NAME}`
                    document.querySelector('#floatingTelefone').value = `${datas.data.CONTACT_MOBILE}`
                    document.querySelector('#floatingProvincia').value = `${datas.data.ADDRESS}`

                } else {
                    responseSweet('Bilhete Inválido', 'error', 'Oops!!')
                }
            })
    })
</script>