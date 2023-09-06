<?php

require_once 'layout/header.php';

//var_dump($_SESSION);
$user_id = $_SESSION['user_id'];
//var_dump($user_id);

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
//var_dump($profile_id);

//Requête pour récupérer les informations du profil
$stmtProfile = $pdo->prepare("SELECT * FROM profiles WHERE id=:id");
$stmtProfile->execute(['id' => $profile_id]);
$profileDetails = $stmtProfile->fetch(PDO::FETCH_ASSOC);
//var_dump($profileDetails);

if ($profileDetails === false) {
    http_response_code(404);
    echo "Not found";
    exit;
}

?>
<div class="container">
    <h1>Mes informations</h1>
    <br>
    <form action="updateProfile.php" method="POST" enctype='multipart/form-data'>

    <div class="form-input">
        <h2>Mon profil</h2>
        <br>
        <div>
            <label for="username">Pseudo:</label>
            <input type="text" name="username" value="<?php echo $profileDetails['username']; ?>">
        </div>
        <br>
        <div>
            <label for="city">Ville:</label>
            <input type="text" name="city" value="<?php echo $profileDetails['city']; ?>">
        </div>
        <br>
        <div>
            <label for="bio">Bio:</label>
            <input type="text" name="bio" value="<?php echo $profileDetails['bio']; ?>">
        </div>
        <br>
        <div>
            <input type="submit" value="Modifier">
            <?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
                <p class="success"><?php echo "Profil modifié avec succès" ?></p>
            <?php } ?>
        </div>
    </div>
    </form>


    <br>

    <div class="form-input">
        <h2>Mon compte</h2>
        <br>
        <p>Prénom:</p>
        <p>Nom:</p>
        <p>Email:</p>
        <p>Mot de passe:</p>
    </div>

</div>



<?php require_once 'layout/footer.php';
