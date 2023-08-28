<?php
require_once 'layout/navbar.php';
?>

<h1>Connexion</h1>

<form action="auth.php" method="POST">
    <div class="form-input">
        <label for="email">Adresse email*</label>
        <input type="text" name="email" required="required" placeholder="ex: xxxxxxxx@gmail.com">
    </div>
    <div class="form-input">
        <label for="pwd">Mot de passe *</label>
        <input type="password" name="pwd" id="myPwd" required="required" placeholder="**********">
        <input type="checkbox" onclick="showPwd()">Afficher le mot de passe
    </div>
    <div>
        <input type="submit" value="Valider"></submit>
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
