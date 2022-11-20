<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> Nouveau catégorie</h4>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?php if (isset($_SESSION['warning'])) { ?>
            <div class="card card-body alert alert-warning alert-dismissible" role="alert">
                <?= $_SESSION['warning'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php }
        unset($_SESSION['warning']);
        if (isset($_POST['create'])) {
            $categorie_name = htmlspecialchars(trim($_POST['categorie_name']));
            $errors = [];

            if (empty($categorie_name)) {
                $errors['empty'] = "Ce champ est obligatoire ! ";
            } else  if (isExistCategorie($categorie_name) >= 1) {
                $errors['exist'] = "Ce catégorie éxiste dejà ! ";
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
                createCategorie($categorie_name);
                $_SESSION['success'] = "Le catégorie à été ajouter avec succès !";
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
                        <input type="text" class="form-control" id="categorie_name" name="categorie_name" placeholder="Entrez la catégorie..." value="<?= isset($_POST['categorie_name']) ? $categorie_name : '' ?>" required>
                        <label for="prenom">Catégorie</label>
                    </div>



                    <div>
                        <button type="submit" name="create" class="btn btn-sm btn-success float-end mb-2"><i class="fas fa-save"></i> Enregistrer</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>