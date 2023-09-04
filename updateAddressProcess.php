<?php

require_once 'functions/db.php';
require_once 'classes/Utils.php';

session_start();
var_dump($_SESSION);
// je récupère l'id de la session pour lier l'adresse à ajouter à cet utilisateur.
$user = $_SESSION['user_id'];
var_dump($user);

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
] = $_POST;

var_dump($_POST);

//VALIDATION zipcode = 5 chiffres + tel

// Je double-check (en plus des attributs required insérés dans les inputs du formulaire) que les champs requis ne soient pas vides
if (!empty($addressName)
&& !empty($category)
&& !empty($status)
&& !empty($street)
&& !empty($zipcode)
&& !empty($city)){
    
    try {
        $pdo = getDbConnection();

        $stmtInsert = $pdo -> prepare("INSERT INTO addresses(addressName, comment, zipcode, city, phone, website, status_id, category_id, street, user_id) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmtInsert->execute([
            $addressName,
            $comment, 
            $zipcode, 
            $city, 
            $phone, 
            $website, 
            $status, 
            $category,
            $street,
            $user
        ]);

        Utils::redirect("addressDetails.php?id=" . $addressDetail['id']);


      } catch (PDOException) {
        echo "Erreur de connexion à la base de données";
        exit;
      }
}else{
    echo "formulaire invalide";
    //Utils::redirect('newAddress.php');
}