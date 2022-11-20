<?php
if (isset($_POST['delete'])) {
    $id = (int) htmlspecialchars(trim($_POST['id']));

    if (!empty($id)) {
        deleteCategorie($id);
        $_SESSION['success'] = "Le catégorie à été supprimer avec succès !";
        echo "<script>window.location.href = 'listes_categories';</script>";
    }
} else {
    echo "<script>window.location.href = 'listes_categories';</script>";
}
