<?php
require_once 'layout/header.php';
?>

<h1>Ajouter une nouvelle addresse</h1>

<form action="addAddressProcess.php" method="POST" enctype='multipart/form-data'>
    <div class="form-input">
        <label for="name">Nom de l'établissement: *</label>
        <input type="text" name="name" required="required" placeholder="La bonne Fourchette, Chez Titi, ...">
    </div>
    <div class="form-input">
        <label for="category">Catégorie: *</label>
        <select name="category" id="category" required>
            <option value="">--Choisir une catégorie--</option>
            <option value="1">Restaurant</option>
            <option value="2">Café</option>
            <option value="3">Bar</option>
            <option value="4">Boutique</option>
        </select>
    </div>
    <div class="form-input">
        <label for="status">Statut: *</label>
        <select name="status" id="status" required>
            <option value="">--Approuvé / à tester ?--</option>
            <option value="1">à tester</option>
            <option value="2">déjà testé</option>
        </select>
    </div>
    <div class="form-input">
        <label for="street">Adresse: *</label>
        <input type="text" name="street" required="required" placeholder="ex: 42 rue de la Tour d'Auvergne">
    </div>
    <div class="form-input">
        <label for="zipcode">Code postal: *</label>
        <input type="int" name="zipcode" id="zipcode" required="required" placeholder="75009, ...">
    </div>
    <div class="form-input">
        <label for="city">Ville: *</label>
        <input type="text" name="city" id="city" required="required" placeholder="Paris, Guingamps, ... " min=10 max=10>
    </div>
    <div class="form-input">
        <label for="phone">Téléphone:</label>
        <input type="tel" name="phone" id="phone" placeholder="07XXXXXXXX" minlength="10" maxlength="12">
    </div>
    <div class="form-input">
        <label for="website">Site:</label>
        <input type="url" name="website" id="website" placeholder="lepingouinvolant.com, ...">
    </div>
    <div class="form-input">
        <label for="comment">Commentaire:</label>
        <textarea name="comment" id="comment" placeholder="Ajouter un commentaire" rows="5" cols="33"></textarea>
    </div>
    <br>
    <div>
        <label for="myFile">Ajouter une photo: (Fichiers autorisés: jpg, jpeg, png / max 3Mo)</label>
        <br>
        <input type="file" name="myFile" />
    </div>
    <br>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>