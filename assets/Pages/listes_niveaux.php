<?php $datas = all_niveaux();
?>
<?php if (isset($_SESSION['success'])) { ?>
    <div class="card card-body alert alert-success alert-dismissible" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php }
unset($_SESSION['success']); ?>


<div class="row">
    <div class="col-md-6 offset-md-2">
        <div class="card">


            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5>Tous les niveaux scolaires</h5>
                </div>

                <div>
                    <a href="create_niveau" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Ajouter un niveau</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Niveau</th>
                            <th class="text-center">Catégories</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="listes">

                        <?php if (count($datas) != 0) {
                            foreach ($datas as $data) {
                        ?>

                                <tr>

                                    <td class="text-center"><strong><?= $data->niveau ?></strong></td>
                                    <td class="text-center"><?= $data->categorie_name ?></td>
                                    <td class="text-center">

                                        <form method="POST" action="delete_niveaux">
                                            <a href="update_niveau&id=<?= $data->n_id ?>" class="btn btn-sm btn-secondary bx bx-edit-alt me-1" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Modifier ce niveau"></i></a>
                                            <input type="hidden" value="<?= $data->n_id ?>" name="id" hidden>
                                            <button type="submit" name="delete" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Attention,la suppression de ce niveau supprimera également tous les étudiants de ce dernier !"><i class="bx bx-trash me-1"></i></button>
                                        </form>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td>Pas de niveaux disponible pour le moment !</td></tr>";
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>