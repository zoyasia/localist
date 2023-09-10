<?php

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';


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


require_once __DIR__ . '/classes/Picture.php';

if (isset($_FILES['myFile'])) {
    $picture = new Picture($_FILES['myFile']);
    $destination = __DIR__ . "/uploads/" . $picture->getFileName();

    $result = $picture->moveUploadedFile($destination);

    echo $result . "<br />";

} else {
    $filename = ""; // Aucun fichier téléchargé
}

$filename = $picture->getFileName();

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