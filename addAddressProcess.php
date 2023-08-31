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
] = $_POST;

if (isset($_FILES['myFile'])) {
    // on met le fichier dans une variable pour une meilleure lisibilité
    $file = $_FILES['myFile'];
    $filename = $file['name'];
    $fileType= pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
    $allowedFiles = ['jpg', 'png', 'jpeg'];
        if(in_array($fileType, $allowedFiles)) {
            echo "type ok";
        } else {
            echo "le format du fichier n'est pas compatible";
        }
} else {
    $file = "";
}

var_dump($_POST);
var_dump($file); 

//VALIDATION zipcode = 5 chiffres + tel


//TESTS DE CODE DE VALIDATION
// $allowedFiles = ['jpg', 'png', 'jpeg'];
// if(in_array($fileType, $allowedFiles)) {
//     echo "type ok";
// } else {
//     echo "le format du fichier n'est pas compatible";
// }

// if(!empty($_FILES['myFile'])){
//     //VALIDATION du type de fichier: jpg/png/jpeg.
// $allowedFiles = ['jpg', 'png', 'jpeg'];
// //je récupère l'extension et si elle correspond à un élément du tableau $allowedFile, c'est OK.
// $fileType= pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
// var_dump($fileType);
//     if(in_array($fileType, $allowedFiles)) {
//         echo "type ok";
//     } else {
//         echo "erreur";
//     }
// } else {
//     $myFile = "";
// }



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
