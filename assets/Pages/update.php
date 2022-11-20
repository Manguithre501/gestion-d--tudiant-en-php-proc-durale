<?php $id = (int) htmlspecialchars(trim($_GET['id']));
$data = findById($id);
if ($data != false) { ?>

    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tableau de bord /</span> Édition d'un étudiant</h4>

    <div class="row">

        <div class="col-md-6 offset-md-3">
            <?php
            if (isset($_POST['update'])) {
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
                    $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];
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
                    update($id, $prenom, $nom, $date_de_naissance, $niveau_id, $sexe);
                    $_SESSION['success'] = "L'étudiant à été mise à jour avec succès !";
                    if (!empty($_FILES['image']['name'])) {
                        update_image($_FILES['image']['tmp_name'], $extension);
                    } ?>
                    <script>
                        window.location.href = 'index.php';
                    </script>;
            <?php
                }
            }

            ?>
            <div class="card">
                <h5 class="card-header">Édition d'un étudiant</h5>
                <!-- Account -->
                <form method="POST" id="form" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="./public/img/avatars/<?= $data->image ?>" alt="user-avatar" class="d-block rounded preview-selected-image" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Uploader un nouveau photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="image" class="account-file-input" hidden accept="image/png, image/jpeg" onchange="previewImage(event);" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG or PNG.</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez le prénom de l'étudiant..." aria-describedby="prenomHelp" value="<?= isset($_POST['prenom']) ? $prenom : $data->prenom ?>" required>
                            <label for="prenom">Prénom</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de l'étudiant..." aria-describedby="nomHelp" value="<?= isset($_POST['nom']) ? $nom : $data->nom  ?>" required>
                            <label for="nom">Nom</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="date_de_naissance" value="<?= isset($_POST['date_de_naissance']) ? $date_de_naissance : $data->date_de_naissance ?>" required>
                            <label for="date_de_naissance">Date de naissance</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-control" name="niveau_id" required>
                                <?php foreach (all_niveaux() as $niveau) : ?>
                                    <option value="<?= $niveau->n_id ?>" <?= $niveau->n_id === $data->niveau_id ? 'selected' : '' ?>><?= $niveau->niveau ?></option>
                                <?php endforeach ?>
                            </select>
                            <label for="prenom">Niveaux scolaires</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-control" name="sexe" required>
                                <option value="1" <?= (int) $data->sexe === 1 ? 'selected' : '' ?>>Garçon</option>
                                <option value="0" <?= (int) $data->sexe === 0 ? 'selected' : '' ?>>Fille</option>
                            </select>
                            <label for="sexe">Genre</label>
                        </div>
                        <div>
                            <button type="submit" name="update" class="btn btn-success float-end mb-3"><i class="fas fa-save"></i> Sauvegarder la modification</button>
                        </div>

                    </div>
                </form>
                <!-- /Account -->
            </div>
        </div>
    </div>

<?php } else {
    echo "<script>window.location.href = 'index.php';</script>";
} ?>

<script src="public/js/app.js"></script>