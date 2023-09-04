<?php
require_once 'functions/db.php';

// je récupère à l'aide de la superglobale $_GET l'id envoyé dans l'url depuis la carte adresse sur landing-page

$id = $_GET['id'] ?? null;

if ($id === null) {
  echo "Merci de préciser un id";
  exit;
}

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

if ($addressDetail === false) {
  http_response_code(404);
  echo "Not found";
  exit;
}


require_once 'layout/header.php';
?>

<div class="container">
  <h1><?php echo $addressDetail['addressName']; ?></h1>
  <div class="container d-flex p-1">
    <div>
      <img src="assets/<?php echo $addressDetail['picture']; ?>" class="card-img-top" alt="photo de l'établissement">
    </div>
    <div class="p-3">
      <p class="card-text"><?php echo $addressDetail['street'] ?></p>
      <p class="card-text"><?php echo $addressDetail['zipcode'] . " " . $addressDetail['city'] ?></p>
      <p class="card-text">Tel: <?php echo $addressDetail['phone'] ?></p>
      <p class="card-text">Site internet:</p><a href="<?php echo $addressDetail['website'] ?>"><?php echo $addressDetail['website'] ?></a>
    </div>
  </div>
  <br>
  <div>
    <p class="card-text">Commentaires:
      <br>
      <?php echo $addressDetail['comment'] ?>
    </p>
  </div>
</div>

<div class="container d-flex p-1">
  <div>
    <a href="updateAddress.php?id=<?php echo $addressDetail['id'];?>">Modifier</a>
  </div>
  <div>
    <button>Supprimer</button>
  </div>
</div>

<?php
require_once 'layout/footer.php';
