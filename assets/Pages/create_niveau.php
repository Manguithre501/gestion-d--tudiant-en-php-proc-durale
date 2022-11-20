<?php if (count(all_categories()) === 0) {
    $_SESSION['warning'] = "Attention,vous devez ajouter un catégorie avant d'ajouter un niveau !";
    echo "<script>window.location.href = 'create_categorie';</script>";
}
?>
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> Ajouter un niveau</h4>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?php

        if (isset($_POST['create'])) {
            $niveau = htmlspecialchars(trim($_POST['niveau']));
            $categorie_id = htmlspecialchars(trim($_POST['categorie_id']));
            $errors = [];

            if (empty($niveau || empty($categorie_id))) {
                $errors['empty'] = "Ce champ est obligatoire ! ";
            } else  if (isExistNiveau($niveau) >= 1) {
                $errors['exist'] = "Ce niveau éxiste dejà ! ";
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
                createNiveau($categorie_id, $niveau);
                $_SESSION['success'] = "Le niveau à été ajouter avec succès !";
                echo "<script>window.location.href = 'listes_niveaux';</script>";
            }
        }

        ?>
        <div class="card mb-4">

            <div class="card-header d-flex justify-content-between">
                <div>
                    <h5>Ajouter un Niveau</h5>
                </div>

                <div>
                    <a href="listes_niveaux" class="btn btn-sm btn-warning"><i class="fas fa-list"></i> Listes des Niveaus</a>
                </div>
            </div>

            <form method="POST" id="form">
                <hr class="my-0" />
                <div class="card-body">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="niveau" name="niveau" placeholder="Entrez la Niveau..." value="<?= isset($_POST['niveau']) ? $niveau : '' ?>" required>
                        <label for="prenom">Niveau</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-control" id="categorie_id" name="categorie_id">
                            <?php foreach (all_categories() as $data) : ?>
                                <option value="<?= $data->id ?>"><?= $data->categorie_name ?></option>
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