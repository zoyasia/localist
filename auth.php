<?php
require_once 'functions/db.php';
require_once 'classes/Utils.php';

//VALIDATION DES DONNEES A EFFECTUER (format email, conformité passwords, champs non vides etc)

// je récupère dans des variables les données entrées dans le formulaire
[
    'email' => $email,
    'pwd' => $pwd
] = $_POST;

var_dump($email);
var_dump($pwd);

// Récupération de la connexion à la base de données
try {
    $pdo=getDbConnection();
} catch (PDOException) {
    echo "La connexion à la base de données n'a pas pu être établie";
    exit;
}

var_dump($pdo);

// Je prépare ma requête SQL
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE email=:email");
// j'exécute ma requête
$stmtUser->execute(['email' => $email]);

$user = $stmtUser->fetch();

var_dump($user);

//je vérifie d'abord la présence de l'utilisateur dans la db, et si je le trouve, je crée une variable qui contient le mdp hashé.
if ($user === false) {
    echo "Utilisateur non trouvé";
    exit;
  } else {
    $pwdHash = $user['pwd'];
  }

  var_dump($pwdHash);
  var_dump($pwd);

// les vardump fonctionnent, je récupère bien le mdp en clair et en hash

  if (password_verify($pwd, $pwdHash)) {
    echo "Login ok";
    // je redirige vers sa page d'accueil personnalisée
    // Utils::redirect('landing-page.php');
  } else {
    echo "Mot de passe incorrect";
  }  