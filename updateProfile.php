<?php

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';

session_start();
//var_dump($_SESSION);
// je récupère l'id de la session pour lier l'adresse à ajouter à cet utilisateur.
$userId = $_SESSION['user_id'];
//var_dump($userId);


// Récupération des données du formulaire d'update de profil
[
    'username' => $username,
    'city' => $city,
    'bio' => $bio,
] = $_POST;

if (
    !empty($username)
    || !empty($city)
    || !empty($bio)
) {

    try {
        $pdo = getDbConnection();

        //Requête pour récupérer le profile_id relié à l'user connecté
        $stmt = $pdo->prepare("SELECT profile_id FROM users WHERE id=:id");
        $stmt->execute(['id' => $userId]);
        $profile_id = $stmt->fetchColumn();

        $stmtUpdate = $pdo->prepare("UPDATE profiles SET username = ?, city = ?, bio = ? WHERE id = ?");
        $stmtUpdate->execute([
            $username,
            $city,
            $bio,
            $profile_id
        ]);
        Utils::redirect("profile.php?success=1");

    } catch (PDOException) {
        echo "Erreur de connexion à la base de données";
        exit;
    }
} else {
    echo "formulaire invalide";
}


require_once __DIR__ . '/layout/footer.php';