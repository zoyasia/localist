<?php
require_once 'layout/header.php';

if (isset($_SESSION['user_id'])) {
  require_once 'functions/db.php';

  // Récupérer l'identifiant de l'utilisateur à partir de la session
  $user_id = $_SESSION['user_id'];

  // Récupérer les données de l'utilisateur depuis la base de données
  try {
      $pdo = getDbConnection();
      $stmt = $pdo->prepare("SELECT firstname FROM users WHERE id = ?");
      $stmt->execute([$user_id]);
      $user = $stmt->fetch();
  } catch (PDOException $e) {
      echo "Erreur de base de données : " . $e->getMessage();
      exit;
  }

  if ($user) {
      $firstname = $user['firstname']; ?>
      <h1>Bienvenue <?php echo $firstname ?> !</h1>
      <?php
  } else {
      echo "Utilisateur introuvable.";
  }
} else {
  echo "Vous n'êtes pas connecté.";
}

//Afficher les adresses enregistrées par le user connecté
$stmtAddress = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
$stmtAddress->execute([$user_id]);
while ($addressList = $stmtAddress->fetch(PDO::FETCH_ASSOC)){
  var_dump($addressList);
};

// var_dump($addressList['addressName']);

?>

<br>

<h2>Mes adresses</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <?php //foreach($addressList as $item) { ?>
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="photo de l'établissement">
      <div class="card-body">
        <h5 class="card-title">Nom</h5>
        <p class="card-text">adresse</p>
      </div>
    </div>
    <?php // } ?>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="photo de l'établissement">
      <div class="card-body">
        <h5 class="card-title">Nom</h5>
        <p class="card-text">adresse</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="photo de l'établissement">
      <div class="card-body">
        <h5 class="card-title">Nom</h5>
        <p class="card-text">adresse</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="..." class="card-img-top" alt="photo de l'établissement">
      <div class="card-body">
        <h5 class="card-title">Nom</h5>
        <p class="card-text">adresse</p>
      </div>
    </div>
  </div>
</div>