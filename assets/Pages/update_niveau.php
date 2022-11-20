<?php $id = (int) htmlspecialchars(trim($_GET['id']));
$data = findOneNiveau($id);
if ($data != false) { ?>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> &Eacute;dition d'un niveau</h4>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php
            if (isset($_POST['create'])) {
                $niveau = htmlspecialchars(trim($_POST['niveau']));
                $categorie_id = htmlspecialchars(trim($_POST['categorie_id']));
                $errors = [];

                if (empty($niveau || empty($categorie_id))) {
                    $errors['empty'] = "Ce champ est obligatoire ! ";
                }

                if (!empty($errors)) {
            ?>
                    <div class="card card-body alert alert-danger alert-dismissible" role="alert">
                        <?php
                        foreach ($errors as $error) {
                            echo $error . "<br/>";
                        }
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                } else {
                    updateNiveau($id, $categorie_id, $niveau);
                    $_SESSION['success'] = "Le niveau à été mis à jour avec succès !";
                    echo "<script>window.location.href = 'listes_niveaux';</script>";
                }
            }

            ?>
            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5>&Eacute;dition d'un niveau</h5>
                    </div>

                    <div>
                        <a href="listes_niveaux" class="btn btn-sm btn-warning"><i class="fas fa-list"></i> Listes des niveaux</a>
                    </div>
                </div>

                <form method="POST" id="form">
                    <hr class="my-0" />
                    <div class="card-body">


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="niveau" name="niveau" placeholder="Entrez la Niveau..." value="<?= isset($_POST['niveau']) ? $niveau : $data->niveau ?>" required>
                            <label for="prenom">Niveau</label>
                        </div>

                        <div class="form-floating mb-3">

                            <!-- <?= isset($_POST['categorie_id']) ? $categorie_id : '' ?> -->
                            <select class="form-control" id="categorie_id" name="categorie_id">
                                <?php foreach (all_categories() as $categorie) : ?>
                                    <option value="<?= $categorie->id ?>" <?= $categorie->id === $data->categorie_id ? 'selected' : '' ?>><?= $categorie->categorie_name ?></option>
                                <?php endforeach ?>
                            </select>
                            <label for="prenom">Catégories</label>
                        </div>

                        <div>
                            <button type="submit" name="create" class="btn btn-sm btn-success float-end mb-2"><i class="fas fa-save"></i> Enregistrer</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } else {
    echo "<script>window.location.href = 'listes_niveaux';</script>";
} ?>