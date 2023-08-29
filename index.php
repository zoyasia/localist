<?php
require_once 'functions/db.php';

try{
    $pdo=getDbConnection();
} catch(PDOException) {
    http_response_code(500);
    echo "La connexion à la base de données a échoué";
    exit;
}

require_once 'layout/navbar.php';
?>

<section class="hero">

    <div class="hero-content">
        <h1>Localist</h1>
        <h2>Vos adresses préférées regroupées en un seul endroit</h2>
    </div>

    <div class="hero-buttons">
        <a href="signin.php" class="hero-btn">Inscription</a>
        <a href="login.php" class="hero-btn">Connexion</a>
    </div>

<!--
        <a href="#modalin" class="hero-btn">Inscription</a>
        <div id="modalin" class="modal" style="display: none;">
            <div class="modal-wrapper">
                <h1>test</h1>
                <p>coucoucouc</p>

            </div>
        </div>        
-->

</section>

<section class="container">
    <h1>Qu'est-ce que c'est ?</h1>
</section>

<!-- <script src="app.js"></script>
-->

<?php
require_once 'layout/footer.php';