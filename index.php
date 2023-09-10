<?php
require_once __DIR__ . '/functions/db.php';

try {
    $pdo = getDbConnection();
} catch (PDOException) {
    http_response_code(500);
    echo "La connexion à la base de données a échoué";
    exit;
}

require_once __DIR__ . '/layout/header.php';
?>

<section class="hero">

    <div class="hero-content">
        <h1>Localist</h1>
        <h2>Vos adresses préférées regroupées en un seul endroit</h2>
    </div>

    <div class="hero-buttons">
        <a href="register.php" class="hero-btn">Inscription</a>
        <a href="login.php" class="hero-btn">Connexion</a>
    </div>


</section>

<section class="container">
    <h1>Qu'est-ce que c'est ?</h1>
    <p>Localist est un carnet d'adresses en ligne où regrouper vos restaurants, cafés, bars et boutiques préférés, déjà testés ou à découvrir.</p>
    <p>
        Pour conserver vos spots favoris, il vous suffit de vous inscrire en deux temps trois mouvements.
        Il est possible d’enrichir votre profil d’un pseudo, d’une bio et de votre ville de résidence, de modifier et de supprimer votre compte.</p>
    <p>ATTENTION! La suppression, d'un compte ou d'une adresse, est définitive</p>
    <p> Lors de l’ajout d’une adresse, vous êtes invité à renseigner son nom, sa localisation, sa catégorie et son statut, et vous êtes libre de renseigner un commentaire à son sujet, un numéro de téléphone, un site, et de télécharger une photo d’illustration. </p>
    <p>Les informations d’une adresse peuvent être mises à jour (changer d’avis, changer de statut par exemple), une adresse peut également être supprimée.</p>

</section>

<?php
require_once 'layout/footer.php';
