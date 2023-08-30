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

// Je prépare ma requête SQL
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE email=:email");
// j'exécute ma requête
$stmtUser->execute(['email' => $email]);

$user = $stmtUser->fetch();

var_dump($user);

if ($user === false) {
    echo "Utilisateur non trouvé";
    exit;
  } else {
    $pwdHash = $user['pwd'];
  }
  

  
  if (password_verify($pwd, $pwdHash)) {
    echo "Login ok";
    //je redirige vers sa page d'accueil personnalisée
  } else {
    echo "Mot de passe incorrect";
  }

/*
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

*/

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