<?php

/*** ******************** ETUDIANTS FUNCTIONS **********************************/

function all(int $nb = null)
{
    global $db;
    $limit = !is_null($nb) ? 'LIMIT ' . $nb : '';
    $req = $db->query("SELECT *,e.id e_id 
    FROM etudiants e 
    LEFT JOIN admins a 
    ON e.admin_id = a.id 
    LEFT JOIN niveaus n
    ON e.niveau_id = n.id 
    WHERE a.role = 'administrateur' ORDER BY e.created_at DESC $limit");
    return  $req->fetchAll(PDO::FETCH_OBJ);
}



function filterBySexe($sexe)
{
    global $db;
    $req = $db->prepare("SELECT *,e.id e_id,n.id n_id
    FROM etudiants e 
    LEFT JOIN admins a 
    ON e.admin_id = a.id 
    LEFT JOIN niveaus n
    ON e.niveau_id = n.id  WHERE e.sexe = ?");
    $req->execute([$sexe]);
    return  $req->fetchAll(PDO::FETCH_OBJ);
}

function filterByNiveau($niveau)
{
    global $db;
    $req = $db->prepare("SELECT *,e.id e_id,n.id n_id
    FROM etudiants e 
    LEFT JOIN admins a 
    ON e.admin_id = a.id 
    LEFT JOIN niveaus n
    ON e.niveau_id = n.id  WHERE e.niveau_id = ?");
    $req->execute([$niveau]);
    return  $req->fetchAll(PDO::FETCH_OBJ);
}


function findById($id)
{
    global $db;
    $req = $db->prepare("SELECT * FROM etudiants e LEFT JOIN admins a ON e.admin_id = a.id WHERE a.role = 'administrateur' AND e.id = ?");
    $req->execute([$id]);
    return  $req->fetch(PDO::FETCH_OBJ);
}

function update($id, $prenom, $nom, $date_de_naissance, $niveau_id, $sexe)
{
    global $db;
    $sql = "UPDATE etudiants SET admin_id=:admin_id,niveau_id=:niveau_id, prenom=:prenom, nom=:nom, date_de_naissance=:date_de_naissance,sexe=:sexe WHERE id=:id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':admin_id', 1, PDO::PARAM_INT);
    $req->bindValue(':niveau_id', $niveau_id, PDO::PARAM_INT);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':date_de_naissance', $date_de_naissance, PDO::PARAM_STR);
    $req->bindValue(':sexe', $sexe, PDO::PARAM_INT);
    $req->execute();
}

function create($prenom, $nom, $date_de_naissance, $niveau_id, $sexe)
{
    global $db;
    $sql = "INSERT INTO etudiants (admin_id,niveau_id,prenom, nom,date_de_naissance,sexe) VALUES(:admin_id,:niveau_id,:prenom, :nom,:date_de_naissance,:sexe)";
    $req = $db->prepare($sql);
    $req->bindValue(':admin_id', 1, PDO::PARAM_INT);
    $req->bindValue(':niveau_id', $niveau_id, PDO::PARAM_INT);
    $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $req->bindValue(':nom', $nom, PDO::PARAM_STR);
    $req->bindValue(':date_de_naissance', $date_de_naissance, PDO::PARAM_STR);
    $req->bindValue(':sexe', $sexe, PDO::PARAM_INT);
    $req->execute();
}

function delete($id)
{
    global $db;
    $sql = "DELETE FROM etudiants WHERE id = :id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
}

function upload_image($tmp_name, $extension)
{
    global $db;
    $id = $db->lastInsertId();
    $i = [
        'id'    =>  $id,
        'image' =>  $id . $extension      //$id = 25 , $extension = .jpg      $id.$extension = "25".".jpg" = 25.jpg
    ];

    $sql = "UPDATE etudiants SET image = :image WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($i);
    move_uploaded_file($tmp_name, IMG . $id . $extension);
}

function update_image($tmp_name, $extension)
{
    global $db;
    $id = (int) $_GET['id'];
    $i = [
        'id'    =>  $id,
        'image' =>  $id . $extension      //$id = 25 , $extension = .jpg      $id.$extension = "25".".jpg" = 25.jpg
    ];

    $sql = "UPDATE etudiants SET image = :image WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($i);
    move_uploaded_file($tmp_name, IMG . $id . $extension);
}

/*** ******************** NIVEAUX FUNCTIONS **********************************/

function all_niveaux()
{
    global $db;
    $req = $db->query("SELECT *,n.id n_id FROM niveaus n LEFT JOIN categories c ON n.categorie_id = c.id ORDER BY n.id DESC");
    return  $req->fetchAll(PDO::FETCH_OBJ);
}

function createNiveau($categorie_id, $niveau)
{
    global $db;
    $sql = "INSERT INTO niveaus(categorie_id,niveau) VALUES(:categorie_id,:niveau)";
    $req = $db->prepare($sql);
    $req->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $req->bindValue(':niveau', $niveau, PDO::PARAM_STR);
    $req->execute();
}


function isExistNiveau($niveau)
{
    global $db;
    $req = $db->prepare("SELECT * FROM niveaus WHERE niveau = :niveau");
    $req->bindValue(':niveau', $niveau, PDO::PARAM_STR);
    $req->execute();
    $exist = $req->rowCount();
    return $exist;
}


function updateNiveau($id, $categorie_id, $niveau)
{
    global $db;
    $sql = "UPDATE niveaus SET categorie_id=:categorie_id, niveau=:niveau WHERE id=:id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $req->bindValue(':niveau', $niveau, PDO::PARAM_STR);
    $req->execute();
}


function findOneNiveau($id)
{
    global $db;
    $req = $db->prepare("SELECT * FROM niveaus WHERE id = ?");
    $req->execute([$id]);
    return $req->fetch(PDO::FETCH_OBJ);
}


function deleteNiveau($id)
{
    global $db;
    $sql = "DELETE n,e FROM niveaus n
    LEFT JOIN etudiants e
    ON n.id = e.niveau_id
    WHERE N.id = :id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
}


/*** ******************** CATEGORIES FUNCTIONS **********************************/


function all_categories()
{
    global $db;
    $req = $db->query("SELECT * FROM categories ORDER BY id DESC");
    return  $req->fetchAll(PDO::FETCH_OBJ);
}

function createCategorie($categorie_name)
{
    global $db;
    $sql = "INSERT INTO categories(categorie_name) VALUES(:categorie_name)";
    $req = $db->prepare($sql);
    $req->bindValue(':categorie_name', $categorie_name, PDO::PARAM_STR);
    $req->execute();
}

function isExistCategorie($categorie_name)
{
    global $db;
    $req = $db->prepare("SELECT * FROM categories WHERE categorie_name = :categorie_name");
    $req->bindValue(':categorie_name', $categorie_name, PDO::PARAM_STR);
    $req->execute();
    $exist = $req->rowCount();
    return $exist;
}

function updateCategorie($id, $categorie_name)
{
    global $db;
    $sql = "UPDATE categories SET categorie_name=:categorie_name WHERE id=:id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->bindValue(':categorie_name', $categorie_name, PDO::PARAM_STR);
    $req->execute();
}

function findOneCategorie($id)
{
    global $db;
    $req = $db->prepare("SELECT * FROM categories WHERE id = ?");
    $req->execute([$id]);
    return  $req->fetch(PDO::FETCH_OBJ);
}

function deleteCategorie($id)
{
    global $db;
    $sql = "DELETE c,n,e FROM categories c 
    LEFT JOIN niveaus n
     ON c.id = n.categorie_id
    LEFT JOIN etudiants e
   ON n.id = e.niveau_id
    WHERE c.id = :id";
    $req = $db->prepare($sql);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
}
