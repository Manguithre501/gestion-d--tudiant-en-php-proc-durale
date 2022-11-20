<?php
if (isset($_POST['delete'])) {
    $id = (int) htmlspecialchars(trim($_POST['id']));

    if (!empty($id)) {
        delete($id);
        $_SESSION['success'] = "L'étudiant à été supprimer avec succès !";
        echo "<script>window.location.href = 'listes';</script>";
    }
} else {
    echo "<script>window.location.href = 'listes';</script>";
}
