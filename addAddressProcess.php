<?php

require_once 'functions/db.php';
require_once 'classes/Utils.php';

// Récupération d'une instance de PDO
try {
    $pdo = getDbConnection();
  } catch (PDOException) {
    echo "Erreur de connexion à la base de données";
    exit;
  }

// Récupération des données du formulaire d'ajout d'adresse
[
    'name' => $addressName,
    'category' => $category,
    'status' => $status,
    'street' => $street,
    'zipcode' => $zipcode,
    'city' => $city,
    'phone' => $phone,
    'website' => $website,
    'comment' => $comment,
    'myFile' => $myFile
] = $_POST;

var_dump($_POST); 

//if name existe pas encore + file est un jpg ou png + zipcode = 5 chiffres + tel

// Je double-check (en plus des attributs required insérés dans les inputs du formulaire) que les champs requis ne soient pas vides
if (!empty($addressName)
&& !empty($category)
&& !empty($status)
&& !empty($street)
&& !empty($zipcode)
&& !empty($city)){
    echo "form ok";
    // insérer le try catch ici ?
}else{
    echo "form NOT OK";
    //Utils::redirect('newAddress.php');
}
