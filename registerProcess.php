<?php

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/classes/Utils.php';
require_once __DIR__ . '/classes/User.php';

// Récupération d'une instance de PDO
try {
  $pdo = getDbConnection();

  // Récupération des données du formulaire d'inscription
  $firstname = $_POST['firstname'];
  $lastname  = $_POST['lastname'];
  $email     = $_POST['email'];
  $pwd  = $_POST['pwd'];
  $pwdConfirm  = $_POST['pwdConfirm'];

  //Validation des données:
  $formData = [
    $firstname,
    $lastname,
    $email,
    $pwd,
    $pwdConfirm
  ];

  $formErrors = UserRegistration::validateForm($formData);

  if (empty($formErrors)) {

    if (UserRegistration::emailExists($pdo, $email)) {
      $formErrors['email'] = "Cette adresse e-mail est déjà utilisée.";
    } else {
      // Toutes les données sont valides, insérer l'utilisateur dans la bdd
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
    }
  }

  require_once __DIR__ . '/layout/header.php';
    echo "<h1>Inscription</h1>";
    foreach ($formErrors as $error) {
        echo "<p>$error</p>";
    }
    echo '<a href="register.php">Retour au formulaire d\'inscription</a>';
    require_once __DIR__ . '/layout/footer.php';

} catch (PDOException) {
  echo "Erreur de connexion à la base de données";
  exit;
}


/*
Validation des données

vérifier que le format du mail est correct

insérer peut-être des contraintes sur le pwd (majuscule, minuscule etc.)

vérifier peut-être que le mail n'existe pas déjà dans la db 

pour vérifier que les 2 pwd saisis sont identiques, insérer peut-être un
if ($password != $confirmpassword) {
echo("Error... Passwords do not match");
exit;
} else { $pwdOK = $pwd} et dans l'execute de la requête, insérer $pwdOK plutôt que pwd ?


  */