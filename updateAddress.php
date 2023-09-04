<?php
require_once 'layout/header.php';

// je récupère à l'aide de la superglobale $_GET l'id envoyé dans l'url depuis la carte adresse sur landing-page

$id = $_GET['id'] ?? null;

if ($id === null) {
    echo "Merci de préciser un id";
    exit;
}

require_once 'functions/db.php';

//Connexion à la base de données
try {
    $pdo = getDbConnection();
} catch (PDOException) {
    http_response_code(500);
    echo "La connexion à la base de données a échoué";
    exit;
}

// je prépare ma requête avec un paramètre nommé pour éviter les injections sql
$stmtDetail = $pdo->prepare("SELECT * FROM addresses WHERE id=:id");
$stmtDetail->execute(['id' => $id]);

$addressDetail = $stmtDetail->fetch(); // renvoit soit l'adresse si elle est trouvée, soit false. Dans ce cas, on envoit un mssg d'erreur 404:


var_dump($addressDetail);

if ($addressDetail === false) {
    http_response_code(404);
    echo "Not found";
    exit;
}

/*
1- dans le lien "Modifier", insérer un $_GET pour récup l'id de l'adresse à modifier
2- récupérer cet id sur cette page
3- Etablir la connexion à la bdd avec un try catch
4- reprendre le formulaire newAddress
Insérer la précédente valeur connue dans le placeholder ?
5- bouton valider modifie la base de données: écrase si le champs est rempli, si aucune donnée n'est entrée dans un champs, alors on conserve la donnée précédemment connue.
*/

?>

<!--Formulaire modification adresse -->
<h1>Modifier mon adresse</h1>
<h2></h2>
<form action="updateAddressProcess.php" method="POST" enctype='multipart/form-data'>
    <h2>
        <input type="text" name="name" value="<?php echo $addressDetail['addressName']; ?>">
    </h2>

    <div class="form-input">
        <label for="category">Catégorie: *</label>
        <select name="category" id="category">
            <option value="">--Choisir une catégorie--</option>
            <option value="1" <?php if ($addressDetail['category_id'] === 1) echo 'selected'; ?>>Restaurant</option>
            <option value="2" <?php if ($addressDetail['category_id'] === 2) echo 'selected'; ?>>Café</option>
            <option value="3" <?php if ($addressDetail['category_id'] === 3) echo 'selected'; ?>>Bar</option>
            <option value="4" <?php if ($addressDetail['category_id'] === 4) echo 'selected'; ?>>Boutique</option>
        </select>
    </div>

    <div class="form-input">
        <label for="status">Statut: *</label>
        <select name="status" id="status">
            <option value="">--Approuvé / à tester ?--</option>
            <option value="1" <?php if ($addressDetail['status_id'] === 1) echo 'selected'; ?>>à tester</option>
            <option value="2" <?php if ($addressDetail['status_id'] === 2) echo 'selected'; ?>>déjà testé</option>
        </select>
    </div>
    <div class="form-input">
        <label for="street">Adresse: *</label>
        <input type="text" name="street" value="<?php echo $addressDetail['street'] ?>">
    </div>
    <div class="form-input">
        <label for="zipcode">Code postal: *</label>
        <input type="int" name="zipcode" id="zipcode" value="<?php echo $addressDetail['zipcode'] ?>">
    </div>
    <div class="form-input">
        <label for="city">Ville: *</label>
        <input type="text" name="city" id="city" value="<?php echo $addressDetail['city'] ?>" min=10 max=10>
    </div>
    <div class="form-input">
        <label for="phone">Téléphone:</label>
        <input type="tel" name="phone" id="phone" value="<?php echo $addressDetail['phone'] ?>" minlength="10" maxlength="12">
    </div>
    <div class="form-input">
        <label for="website">Site:</label>
        <input type="url" name="website" id="website" value="<?php echo $addressDetail['website'] ?>">
    </div>
    <div class="form-input">
        <label for="comment">Commentaire:</label>
        <textarea name="comment" id="comment" value="<?php echo $addressDetail['comment'] ?>" rows="5" cols="33"></textarea>
    </div>
    <br>
    
<!-- AJOUTER UPLOAD FICHIER : VERIFICATION + SUPPRESSION DE LA PRECEDEENTE SI EXISTANTE-->

    <br>
    <div class="d-flex p-1">
        <div>
            <input type="submit" value="Valider">
        </div>
        <div>
            <a href="addressDetails.php?id=<?php echo $addressDetail['id']; ?>"" class=" p-5">Retour</a>
        </div>
    </div>
</form>
<br>