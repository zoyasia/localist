<?php
require_once 'layout/navbar.php';
?>

<h1>Inscription</h1>

<form action="" method="POST"
    <div class="form-input">
        <label for="id">Prénom *</label>
        <input type="text" name="firstname" required="required" placeholder="Patti">
    </div>
    <div class="form-input">
        <label for="id">Nom *</label>
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
