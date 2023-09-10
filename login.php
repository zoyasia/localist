<?php
require_once __DIR__ . '/layout/header.php';
?>

<h1>Connexion</h1>

<form action="auth.php" method="POST">
    <div class="form-input">
        <label for="email">Adresse email: *</label>
        <input type="email" name="email" required="required" placeholder="ex: xxxxxxxx@gmail.com">
    </div>
    <div class="form-input">
        <label for="pwd">Mot de passe: *</label>
        <input type="password" name="pwd" id="pwd" required="required" placeholder="**********">
        <input type="checkbox" onclick="showPwd()">Afficher le mot de passe
    </div>
    <div>
        <input type="submit" value="Se connecter"></submit>
    </div>
</form>

<br>

<a href="index.php">Retour à l'accueil</a>

<!--fonctionnalité JS qui me permet, si je le souhaite, de voir les caractères entrés dans le champs pwd -->
<script>
function showPwd() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<?php
require_once __DIR__ . '/layout/footer.php';
?>