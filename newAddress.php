<?php
require_once 'layout/header.php';
?>

<h1>Ajouter une nouvelle addresse</h1>

<form action="addAddressProcess.php" method="POST">
    <div class="form-input">
        <label for="name">Nom de l'établissement: *</label>
        <input type="text" name="firstname" required="required" placeholder="La bonne Fourchette, Chez Titi, ...">
    </div>
    <div class="form-input">
        <label for="category">Catégorie: *</label>
        <select name="category" id="category">
            <option value="">--Choisir une catégorie--</option>
            <option value="restaurant">Restaurant</option>
            <option value="coffeeshop">Café</option>
            <option value="bar">Bar</option>
            <option value="shop">Boutique</option>
        </select>
    </div>
    <div class="form-input">
        <label for="status">Statut: *</label>
        <select name="status" id="status">
            <option value="">--Approuvé / à tester ?--</option>
            <option value="tested">déjà testé</option>
            <option value="toBeTested">à tester</option>
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
        <input type="text" name="city" id="city" required="required" placeholder="Paris, Guingamps, ... ">
    </div>
    <div class="form-input">
        <label for="phone">Téléphone:</label>
        <input type="tel" name="phone" id="phone" placeholder="07XXXXXXXX">
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
        <label for="myFile">Ajouter une photo:</label>
        <input type="file" name="myFile" />
    </div>
    <br>
    <div>
        <input type="submit" value="Valider">
    </div>
</form>