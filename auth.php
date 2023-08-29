<?php
require_once 'data/users.php';
require_once 'functions/db.php';
require_once 'classes/Utils.php';

session_start();
// je récupère dans des variables les données entrées dans le formulaire
$enteredEmail = $_POST['email'];
$enteredPwd = $_POST['pwd'];

var_dump($enteredEmail);
var_dump($enteredPwd);

// Récupération de la connexion à la base de données
$pdo=getDbConnection();
var_dump($pdo);


// Je prépare ma requête SQL
$stmtconnect = $pdo->prepare("SELECT * FROM users WHERE email = ? AND pwd = ?");
// je lie les paramètres à différentes valeurs
$stmtconnect->bindValue(1, $_POST['email'], PDO::PARAM_STR);
$stmtconnect->bindValue(2, $_POST['pwd'], PDO::PARAM_STR);
// j'exécute ma requête
$stmtconnect->execute();

$user = $stmtconnect->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Authentification réussie
    // je stocke les informations d'utilisateur dans la session
    $_SESSION['user'] = $user;
    //je redirige vers sa page d'accueil personnalisée
    Utils::redirect('landing-page.php');
} else {
    // Authentification échouée
    echo "L'authentification n'a pas abouti, veuillez réessayer";
}

/*
Méthode utilisant un tableau de données entrées manuellement dans data/users.php

$foundUser = false;

foreach($users as $user){
    if($user->email === $enteredEmail && $user->password === $enteredPwd) {
        $foundUser=true;
        Utils::redirect('landing-page.php');
        break;
    } else {
        echo "authentification échouée";
        break;
    }
};

*/