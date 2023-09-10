<?php

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';

// Récupération d'une instance de PDO
try {
    $pdo = getDbConnection();
  } catch (PDOException) {
    echo "Erreur de connexion à la base de données";
    exit;
  }

// Récupération des données du formulaire d'inscription
$firstname = $_POST['firstname'];
$lastname  = $_POST['lastname'];
$email     = $_POST['email'];
$pwd  = $_POST['pwd'];
$pwdConfirm  = $_POST['pwdConfirm'];

// Validation des données

  //vérifier que le format du mail est correct

  // insérer peutêtre des contraintes sur le pwd (majuscule, minuscule etc.)

  // vérifier peut-être que le mail n'existe pas déjà dans la db 

  // pour vérifier que les 2 pwd saisis sont identiques, insérer peut-être un
  //if ($password != $confirmpassword) {
  //echo("Error... Passwords do not match");
  //exit;
  //} else { $pwdOK = $pwd} et dans l'execute de la requête, insérer $pwdOK plutôt que pwd ?

// Préparation de la requête avec les paramètres adéquats
$stmtRegister = $pdo->prepare("INSERT INTO users(firstname, lastname, email, pwd) VALUES (?, ?, ?, ?)");

// Exécution de la requête
$stmtRegister->execute([
  $firstname,
  $lastname,
  $email,
  password_hash($pwd, PASSWORD_DEFAULT)
]);

session_start();
$_SESSION['user_id'] = $pdo->lastInsertId();

Utils::redirect('landing-page.php');
exit;