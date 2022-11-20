<?php $id = (int) htmlspecialchars(trim($_GET['id']));
$data = findOneCategorie($id);

if ($data != false) { ?>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> Nouveau catégorie</h4>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php
            if (isset($_POST['update'])) {
                $categorie_name = htmlspecialchars(trim($_POST['categorie_name']));
                $errors = [];

                if (empty($categorie_name)) {
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
                    updateCategorie($id, $categorie_name);
                    $_SESSION['success'] = "Le catégorie à été mis à jour avec succès !";
                    echo "<script>window.location.href = 'listes_categories';</script>";
                }
            }

            ?>
            <div class="card mb-4">

                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5>Nouveau catégories</h5>
                    </div>

                    <div>
                        <a href="listes_categories" class="btn btn-sm btn-warning"><i class="fas fa-list"></i> Listes des catégories</a>
                    </div>
                </div>

                <form method="POST" id="form">
                    <hr class="my-0" />
                    <div class="card-body">


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="categorie_name" name="categorie_name" placeholder="Entrez la catégorie..." value="<?= isset($_POST['categorie_name']) ? $categorie_name : $data->categorie_name ?>" required>
                            <label for="prenom">Catégorie</label>
                        </div>



                        <div>
                            <button type="submit" name="update" class="btn btn-sm btn-success float-end mb-2"><i class="fas fa-save"></i> Enregistrer</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } else {
    echo "<script>window.location.href = 'listes_categories';</script>";
} ?>