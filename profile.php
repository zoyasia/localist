<?php

require_once 'layout/header.php';

var_dump($_SESSION);
$user_id = $_SESSION;
var_dump($user_id);

require_once 'functions/db.php';

//Connexion à la base de données
try {
    $pdo = getDbConnection();
} catch (PDOException) {
    http_response_code(500);
    echo "La connexion à la base de données a échoué";
    exit;
}

$stmt = $pdo->prepare("SELECT profile_id FROM users WHERE id=:id");
$stmt->execute(['id' => $user_id]);

$profileDetail = $stmt->fetch();
var_dump($profileDetail);

?>
<div class="container">
    <h1>Mes informations</h1>
    <br>
    <form action="#" method="POST" enctype='multipart/form-data'></form>
    
    <div>
        <h2>Mon profil</h2>
        <br>
        <p>Pseudo:</p>
        <p>Ville:</p>
        <p>Bio:</p>
        <p>Mot de passe:</p>

    </div>
    
    <br>
    
    <div>
        <h2>Mon compte</h2>
        <br>
        <p>Prénom:</p>
        <p>Nom:</p>
        <p>Email:</p>
        <p>Mot de passe:</p>
    </div>

</div>



<?php require_once 'layout/footer.php';
