<?php

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';

session_start();
//var_dump($_SESSION);
// je récupère l'id de la session pour lier l'adresse à ajouter à cet utilisateur.
$user = $_SESSION['user_id'];

$addressId = $_GET['id'] ?? null;

if ($addressId === null) {
    echo "Merci de préciser un id";
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

//insérer VALIDATION zipcode = 5 chiffres + tel

// Je double-check (en plus des attributs required insérés dans les inputs du formulaire) que les champs requis ne soient pas vides
if (!empty($addressName)
&& !empty($category)
&& !empty($status)
&& !empty($street)
&& !empty($zipcode)
&& !empty($city)){
    
    try {
        $pdo = getDbConnection();

        $stmtUpdate = $pdo -> prepare("UPDATE addresses SET addressName = ?, comment = ?, street = ?, zipcode = ?, city = ?, phone = ?, website = ?, category_id= ?, status_id= ? WHERE id = ? AND user_id = ?");
        $stmtUpdate->execute([
            $addressName,
            $comment,
            $street,
            $zipcode, 
            $city, 
            $phone, 
            $website,
            $category, 
            $status, 
            $addressId,
            $user
        ]);


        // WARNING !!!!!!!! ne redirige pas vers l'id. $addressDetail n'existe pas dans cette page
        Utils::redirect("addressDetails.php?id=" . $addressId);


      } catch (PDOException) {
        echo "Erreur de connexion à la base de données";
        exit;
      }
}else{
    echo "formulaire invalide";
    //Utils::redirect('newAddress.php');
}
