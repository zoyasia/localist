<?php

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';

session_start();
var_dump($_SESSION);
// je récupère l'id de la session pour lier l'adresse à ajouter à cet utilisateur.
$userId = $_SESSION['user_id'];
var_dump($userId);

// Récupération des données du formulaire d'update des infos perso du compte
[
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'newpwd' => $newpwd,
    'newpwdconf' => $newpwdconf,
] = $_POST;

var_dump($_POST);

if (
    !empty($firstname)
    || !empty($lastname)
    || !empty($email)
    || (!empty($newpwd) && !empty($newpwdconf) && ($newpwd === $newpwdconf))
) {

    try {
        $pdo = getDbConnection();

        // Vérifie si un nouveau mot de passe a été fourni
        if (!empty($newpwd)) {
            // Hachage du nouveau mot de passe
            $hashedPwd = password_hash($newpwd, PASSWORD_DEFAULT);

        $stmtUpdate = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, pwd = ? WHERE id = ?");
        $stmtUpdate->execute([
            $firstname,
            $lastname,
            $email,
            $hashedPwd,
            $userId
        ]);
    }else{
        // Met à jour les données de l'utilisateur sans modifier le mot de passe
        $stmtUpdate = $pdo->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ?");
        $stmtUpdate->execute([$firstname, $lastname, $email, $userId]);
    }

    Utils::redirect("profile.php?success=2");
    
    } catch (PDOException) {
        echo "Erreur de connexion à la base de données";
        exit;
    }
} else {
    echo "Formulaire invalide";
}
