<?php
require_once 'layout/header.php';
?>

<h1>Inscription</h1>

<form action="registerProcess.php" method="POST">
    <div class="form-input">
        <label for="firstname">Prénom: *</label>
        <input type="text" name="firstname" required="required" placeholder="Patti">
    </div>
    <div class="form-input">
        <label for="lastname">Nom: *</label>
        <input type="text" name="lastname" required="required" placeholder="Smith">
    </div>
    <div class="form-input">
        <label for="email">Email: *</label>
        <input type="text" name="email" required="required" placeholder="ex: xxxxxxxx@gmail.com">
    </div>
    <div class="form-input">
        <label for="pwd">Définir un mot de passe: *</label>
        <input type="password" name="pwd" id="pwd" required="required" placeholder="**********">
    </div>
    <div class="form-input">
        <label for="pwdConfirm">Confirmer le mot de passe: *</label>
        <input type="password" name="pwdConfirm" id="pwdConfirm" required="required" placeholder="**********">
    </div>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>

<a href="index.php">Retour à l'accueil</a>

<?php require_once 'layout/footer.php';