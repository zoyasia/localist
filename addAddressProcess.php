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
    'status' => $status_id,
    'street' => $street,
    'zipcode' => $zipcode,
    'city' => $city,
    'phone' => $phone,
    'website' => $website,
    'comment' => $comment,
] = $_POST;

if (isset($_FILES['myFile'])) {
    // on met le fichier dans une variable pour une meilleure lisibilité et j'essaye ensuite d'extraire son nom et son extension pour vérifier que cette dernière fasse partie des extensions autorisées
    $file = $_FILES['myFile'];
    $filename = $file['name'];
    $fileType= pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
    $allowedFiles = ['jpg', 'png', 'jpeg'];
        if(in_array($fileType, $allowedFiles)) {
            echo "le format du fichier est compatible";
        } else {
            echo "le format du fichier n'est pas compatible";
        }
} else {
    $file = "";
}

var_dump($_POST);
var_dump($file); 

//VALIDATION zipcode = 5 chiffres + tel

// Je double-check (en plus des attributs required insérés dans les inputs du formulaire) que les champs requis ne soient pas vides
if (!empty($addressName)
&& !empty($category)
&& !empty($status_id)
&& !empty($street)
&& !empty($zipcode)
&& !empty($city)){
    
    try {
        $pdo = getDbConnection();

        $stmtInsert = $pdo -> prepare("INSERT INTO addresses(addressName, picture, comment, zipcode, city, phone, website, testStatus, category_id, street, user_id) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmtInsert->execute([
            $addressName,
            $filename,
            $comment, 
            $zipcode, 
            $city, 
            $phone, 
            $website, 
            $status_id, 
            $category,
            $street,
            $user
        ]);

        Utils::redirect("landing-page.php");


      } catch (PDOException) {
        echo "Erreur de connexion à la base de données";
        exit;
      }
}else{
    echo "formulaire invalide";
    //Utils::redirect('newAddress.php');
}



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
