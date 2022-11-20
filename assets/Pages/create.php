<?php if (count(all_niveaux()) === 0 || count(all_categories()) === 0) {
    $_SESSION['warning'] = "Attention,vous devez ajouter un niveau et un catégorie avant d'ajouter un étudiant !";
    echo "<script>window.location.href = 'create_categorie';</script>";
}
?>

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> Nouveau étudiant</h4>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <?php
        if (isset($_POST['create'])) {
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $nom = htmlspecialchars(trim($_POST['nom']));
            $date_de_naissance = htmlspecialchars(trim($_POST['date_de_naissance']));
            $niveau_id = (int) htmlspecialchars(trim($_POST['niveau_id']));
            $sexe = (int) htmlspecialchars(trim($_POST['sexe']));
            $errors = [];

            if (empty($prenom) || empty($nom) || empty($date_de_naissance)) {
                $errors['empty'] = "Veuillez remplir tous les champs";
            }

            if (!empty($_FILES['image']['name'])) {
                $file = $_FILES['image']['name'];
                $extensions = ['.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG'];
                $extension = strrchr($file, '.');

                if (!in_array($extension, $extensions)) {
                    $errors['image'] = "Cette image n'est pas valable";
                }
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

                if (!empty($_FILES['image']['name'])) {
                    create($prenom, $nom, $date_de_naissance, $niveau_id, $sexe);
                    upload_image($_FILES['image']['tmp_name'], $extension);
                    $_SESSION['success'] = "L'étudiant à été ajouter avec succès !";
                    echo "<script>window.location.href = 'index.php';</script>";
                } else { ?>
                    <div class="card card-body alert alert-danger alert-dismissible" role="alert">
                        L'image est obligatoire !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        <?php }
            }
        }

        ?>
        <div class="card mb-4">
            <h5 class="card-header">Nouveau étudiant</h5>
            <form method="POST" id="form" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="./public/img/avatars/user.png" alt="user-avatar" class="d-block rounded preview-selected-image" height="100" width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Uploader un nouveau photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="image" class="account-file-input" hidden accept="image/png,image/jpeg" onchange="previewImage(event);" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Autorisé JPG or PNG.</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="prenom" placeholder="Entrez le prénom de l'étudiant..." value="<?= isset($_POST['prenom']) ? $prenom : '' ?>" required>
                        <label for="prenom">Prénom</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nom" placeholder="Entrez le nom de l'étudiant..." value="<?= isset($_POST['nom']) ? $nom : '' ?>" required>
                        <label for="nom">Nom</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="date_de_naissance" value="<?= isset($_POST['date_de_naissance']) ? $date_de_naissance : '' ?>" required>
                        <label for="date_de_naissance">Date de naissance</label>
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-control" name="niveau_id" required>
                            <?php foreach (all_niveaux() as $data) : ?>
                                <option value="<?= $data->n_id ?>"><?= $data->niveau ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="prenom">Niveaux scolaires</label>
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-control" name="sexe" required>
                            <option value="1">Garçon</option>
                            <option value="0">Fille</option>
                        </select>
                        <label for="sexe">Genre</label>
                    </div>


                    <div>
                        <button type="submit" name="create" class="btn btn-success float-end"><i class="fas fa-save"></i> Enregistrer</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script src="public/js/app.js"></script>