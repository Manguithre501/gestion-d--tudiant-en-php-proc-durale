<?php
session_start();
try {
    $db = new PDO("mysql:host=localhost;port=3308;dbname=gEtudiants", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}


function sessions()
{
    global $db;
    $req = $db->prepare("SELECT * FROM admins WHERE email = :email");
    $req->bindValue(':email', $_SESSION['admins'], PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ);
}



if (!empty($_SESSION['admins'])) {
    $session = sessions();
    $id_session = (int) $session->id;
    $email = $session->email;
    $avatar = $session->avatar;
    $userName = ucfirst($session->username);
    $role = ucfirst($session->role);
}


function isConnected()
{
    if (isset($_SESSION['admins'])) {

        echo "<script>window.location.href = 'index.php';
        </script>";
    }
}

function isNotConnected()
{
    global $page;
    if ($page != 'login' && !isset($_SESSION['admins'])) {

        echo "<script>window.location.href = 'login';
        </script>";
    }
}
