<?php
if (isset($_POST['delete'])) {
    $id = (int) htmlspecialchars(trim($_POST['id']));

    if (!empty($id)) {
        deleteNiveau($id);
        $_SESSION['success'] = "Le niveau à été supprimer avec succès !";
        echo "<script>window.location.href = 'listes_niveaux';</script>";
    }
} else {
    echo "<script>window.location.href = 'listes_niveaux';</script>";
}
