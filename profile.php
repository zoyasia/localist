<?php

require_once 'layout/header.php';

var_dump($_SESSION);
$user_id = $_SESSION['user_id'];
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

//Requête pour récupérer le profile_id relié à l'user connecté
$stmt = $pdo->prepare("SELECT profile_id FROM users WHERE id=:id");
$stmt->execute(['id' => $user_id]);
$profile_id = $stmt->fetchColumn(); // j'ai remplacé le fetchAll qui donnait un tableau de tableau pour simplifier le code
var_dump($profile_id);

//Requête pour récupérer le profile_id relié à l'user connecté
$stmtProfile = $pdo->prepare("SELECT * FROM profiles WHERE id=:id");
$stmtProfile->execute(['id'=>$profile_id]);
$profileDetails = $stmtProfile->fetch(PDO::FETCH_ASSOC);
var_dump($profileDetails);

if ($profileDetails === false) {
    http_response_code(404);
    echo "Not found";
    exit;
}

?>
<div class="container">
    <h1>Mes informations</h1>
    <br>
    <form action="#" method="POST" enctype='multipart/form-data'></form>
    
    <div class="form-input">
        <h2>Mon profil</h2>
        <br>
        <p>Pseudo: <?php echo $profileDetails['username']; ?></p>
        <p>Ville: <?php echo $profileDetails['city']; ?></p>
        <p>Bio: <?php echo $profileDetails['bio']; ?></p>
    </div>
    
    <br>
    
    <div class="form-input">
        <h2>Mon compte</h2>
        <br>
        <p>Prénom: <?php ; ?></p>
        <p>Nom:</p>
        <p>Email:</p>
        <p>Mot de passe:</p>
    </div>

</div>



<?php require_once 'layout/footer.php';
