<?php
require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';

//VALIDATION DES DONNEES A EFFECTUER (format email, conformité passwords, champs non vides etc)

// je récupère dans des variables les données entrées dans le formulaire
[
    'email' => $email,
    'pwd' => $pwd
] = $_POST;

// Récupération de la connexion à la base de données
try {
    $pdo=getDbConnection();
} catch (PDOException) {
    echo "La connexion à la base de données n'a pas pu être établie";
    exit;
}

// Je prépare ma requête SQL
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE email=:email");
// j'exécute ma requête
$stmtUser->execute(['email' => $email]);

$user = $stmtUser->fetch();

//je vérifie d'abord la présence de l'utilisateur dans la db, et si je le trouve, je crée une variable qui contient le mdp hashé.
if ($user === false) {
    echo "Utilisateur non trouvé";
    exit;
  } else {
    $pwdHash = $user['pwd'];
  }

// les vardump fonctionnent, je récupère bien le mdp en clair et en hash

//Si les mots de passe correspondent, je redirige l'utilisateur vers sa page d'accueil personnalisée

  if (password_verify($pwd, $pwdHash)) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    Utils::redirect('landing-page.php');
    exit;
  } else {
    echo "Mot de passe incorrect";
  }  