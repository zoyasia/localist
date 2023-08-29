<?php
require_once 'layout/navbar.php';
require_once 'functions/db.php';

// je récupère dans des variables les données entrées dans le formulaire
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];

// Récupération de la connexion à la base de données
$pdo=getDbConnection();

// Je prépare la requête SQL avec des paramètres
$stmtinsert = $pdo->prepare("INSERT INTO users (firstname, lastname, email, pwd) VALUES (?, ?, ?, ?)");

// j'exécute la requête en liant les valeurs aux paramètres
$stmtinsert->execute([$firstname, $lastname, $email, $pwd]);
?>

<h1>Inscription</h1>

<form action="" method="POST">
    <div class="form-input">
        <label for="firstname">Prénom *</label>
        <input type="text" name="firstname" required="required" placeholder="Patti">
    </div>
    <div class="form-input">
        <label for="lastname">Nom *</label>
        <input type="text" name="lastname" required="required" placeholder="Smith">
    </div>
    <div class="form-input">
        <label for="email">Email *</label>
        <input type="text" name="email" required="required" placeholder="ex: xxxxxxxx@gmail.com">
    </div>
    <div class="form-input">
        <label for="pwd">Définir un mot de passe *</label>
        <input type="password" name="pwd" id="myPwd" required="required" placeholder="**********">
        <input type="checkbox" onclick="showPwd()">Afficher le mot de passe
    </div>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>

<a href="index.php">Retour à l'accueil</a>

<script>
function showPwd() {
  var x = document.getElementById("myPwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
