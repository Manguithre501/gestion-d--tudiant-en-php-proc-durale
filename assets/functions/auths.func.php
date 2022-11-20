<?php


function login($email, $password)
{
    global $db;
    $req = $db->prepare("SELECT password FROM admins WHERE email = :email");
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->execute();
    $password_from_bdd = ($req->fetch(PDO::FETCH_OBJ))->password;

    if (password_verify(@$password, $password_from_bdd)) {
        return true;
    } else {
        return false;
    }
}
