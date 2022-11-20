<?php
if (isset($_GET['niveau'])) {
    $niveau = (int) $_GET['niveau'];
    $datas =  $niveau != 0 ? filterByNiveau($niveau) : all();;
} else {
    $datas = all();
}

$nbEtudiants = count($datas) > 0  ? "Listes de tout les étudiants (" . count($datas) . ')' : 'Liste d\'étudiant (' . count($datas) . ')';
?>

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> Listes des étudiants</h4>

<?php if (isset($_SESSION['success'])) { ?>
    <div class="card card-body alert alert-success alert-dismissible" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php }
unset($_SESSION['success']); ?>


<div class="card mb-5">
    <div class="card-header">
        Filtrer par
    </div>
    <div class="card-body">
        <form method="get">
            <div class="row d-flex">
                <!--  <div class="col-md-4">
                    <select name="sexe" class="form-control">
                        <option value="1" <?= isset($_GET['sexe']) && $id === 1 ? 'selected' : '' ?>>Garçon</option>
                        <option value="0" <?= isset($_GET['sexe']) && $id === 0 ? 'selected' : '' ?>>Fille</option>
                    </select>
                </div>
 -->
                <div class="col-md-10">
                    <select name="niveau" class="form-control">
                        <option value="0">Tous</option>
                        <?php foreach (all_niveaux() as $niveau) :  ?>
                            <option value="<?= $niveau->n_id ?>"><?= $niveau->niveau ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"> <i class="bx bx-filter-alt"></i> Filtrer</button>
                </div>
            </div>

        </form>
    </div>
</div>


<div class="card">

    <h5 class="card-header"><?= $nbEtudiants ?></h5>
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
                    echo "<tr><td>Pas d'étudiants disponible pour le moment !</td></tr>";
                }
                ?>


            </tbody>
        </table>
    </div>
</div>