<?php




$datas = all(5); ?>
<?php if (isset($_SESSION['success'])) { ?>
    <div class="card card-body alert alert-success alert-dismissible" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php }
unset($_SESSION['success']);
unset($_SESSION['warning']);
?>


<div class="row">
    <div class="col-lg-12 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-6 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-end">

                            <div class="dropdown ">
                                <button class="btn p-0 text-white" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="listes">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">&Eacute;tudiants totals</span>
                        <h3 class="card-title mb-2 text-white"><?= count(all()) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-6 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-end">

                            <div class="dropdown">
                                <button class="btn p-0 text-white" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="listes_niveaux">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                        <span>Niveaux totals</span>
                        <h3 class="card-title text-nowrap mb-1 text-white"><?= count(all_niveaux()) ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-6 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-end">

                            <div class="dropdown">
                                <button class="btn p-0 text-white" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="listes_categories">Voir les détails</a>
                                </div>
                            </div>
                        </div>
                        <span>Catégories totals</span>
                        <h3 class="card-title text-nowrap mb-1 text-white"><?= count(all_categories()) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="card">

    <h5 class="card-header">Les 5 nouveaux étudiants</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">Photo</th>
                    <th>Nom et Prénom</th>
                    <th>Date de naissance</th>
                    <th class="text-center">sexe</th>
                    <th class="text-center">Niveau</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="listes">

                <?php if (count($datas) != 0) {
                    foreach ($datas as $data) {
                ?>

                        <tr>
                            <td class="text-center"><img src="./public/img/avatars/<?= $data->image ?>" alt="Avatar" class="rounded-circle" width="30" height="30" /></td>
                            <td><strong><?= $data->nom . ' ' . $data->prenom ?></strong></td>
                            <td><?= myDate($data->date_de_naissance); ?></td>
                            <td class="text-center"><?= (int) $data->sexe === 1 ? 'Garçon' : 'Fille' ?></td>
                            <td class="text-center"><?= $data->niveau ?></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="update&id=<?= $data->e_id ?>"><i class="bx bx-edit-alt me-1"></i> Modifier</a>
                                        <form method="POST" action="delete">
                                            <input type=" hidden" value="<?= $data->e_id ?>" name="id" hidden>
                                            <button type="submit" name="delete" class="dropdown-item"><i class="bx bx-trash me-1"></i> Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php }
                } else {
                    echo "<tr>
                    <td></td>
                    <td></td>
                    <td><span class='badge bg-danger'>Pas d'étudiant disponible pour le moment</span></td></tr>";
                }
                ?>


            </tbody>
        </table>
    </div>
</div>