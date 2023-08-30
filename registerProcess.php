<?php

require_once 'functions/db.php';
require_once 'classes/Utils.php';

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

// Préparation de la requête avec les paramètres adéquats
$stmtInsert = $pdo->prepare("INSERT INTO users(firstname, lastname, email, pwd) VALUES (?, ?, ?, ?)");

// Exécution de la requête
$stmtInsert->execute([
  $firstname,
  $lastname,
  $email,
  password_hash($pwd, PASSWORD_DEFAULT)
]);

session_start();
$_SESSION['user_id'] = $pdo->lastInsertId();

Utils::redirect('landing-page.php');
exit;