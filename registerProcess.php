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

  $formErrors = UserRegistration::validateForm($pdo, $formData);

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
    foreach ($formErrors as $key => $error) {
      if (is_array($error)) {
          foreach ($error as $subError) {
              echo "<p>$subError</p>";
          }
      } else {
          echo "<p>$error</p>";
      }
  }

    echo '<a href="register.php">Retour au formulaire d\'inscription</a>';
    require_once __DIR__ . '/layout/footer.php';

} catch (PDOException) {
  http_response_code(500);
  echo "Erreur de connexion à la base de données";
  exit;
}
