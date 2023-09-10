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


require_once 'classes/Picture.php';

if (isset($_FILES['myFile'])) {
    $picture = new Picture($_FILES['myFile']);
    $destination = __DIR__ . "/uploads/" . $picture->getFileName();

    $result = $picture->moveUploadedFile($destination);

    echo $result . "<br />";


} else {
    $filename = ""; // Aucun fichier téléchargé
}

$filename = $picture->getFileName();

/* CODE VALIDE POUR VERIFICATION UPLOAD

if (isset($_FILES['myFile'])) {
    // on met le fichier dans une variable pour une meilleure lisibilité et j'essaye ensuite d'extraire son nom et son extension pour vérifier que cette dernière fasse partie des extensions autorisées
    $file = $_FILES['myFile'];
    $filename = $file['name'];
    $fileType = pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
    $fileSize = $file['size'];
    $allowedFiles = ['jpg', 'png', 'jpeg'];

    // validation de la taille et du type de fichier
    if ($fileSize > 3 * 1024 * 1024) { // 3 Mo
        echo "Le fichier est trop volumineux.";
    } elseif (!in_array($fileType, $allowedFiles)) {
        echo "Le format du fichier n'est pas compatible.";
    } else {

        // Tout est OK, déplacer le fichier vers l'emplacement souhaité
        $destination = __DIR__ . "/uploads/" . $filename; // Répertoire de destination

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo $filename . " téléchargé avec succès <br />";
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    }
} else {
    $filename = ""; // Aucun fichier téléchargé
}
*/ 

/* Ancienne version de validation type fichier

    if(in_array($fileType, $allowedFiles)) {
        echo "le format du fichier est compatible";
    } else {
        echo "le format du fichier n'est pas compatible";
    }
} else {
$file = "";
}

*/


var_dump($_POST);
//var_dump($file);


//VALIDATION zipcode = 5 chiffres + tel


// Je double-check (en plus des attributs required insérés dans les inputs du formulaire) que les champs requis ne soient pas vides
if (
    !empty($addressName)
    && !empty($category)
    && !empty($status_id)
    && !empty($street)
    && !empty($zipcode)
    && !empty($city)
) {

    try {
        $pdo = getDbConnection();


        $stmtInsert = $pdo->prepare("INSERT INTO addresses(addressName, picture, comment, street, zipcode, city, phone, website, category_id, user_id, status_id) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        $stmtInsert->execute([
            $addressName,
            $filename,
            $comment,
            $street,
            $zipcode,
            $city,
            $phone,
            $website,
            $category,
            $user,
            $status_id
        ]);


        Utils::redirect("landing-page.php");
    } catch (PDOException) {
        http_response_code(500);
        echo "Erreur de connexion à la base de données";
        exit;
    }
} else {
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
