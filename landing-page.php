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

// //Afficher les adresses enregistrées par le user connecté
// $stmtAddress = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
// $stmtAddress->execute([$user_id]);
// while ($addressList = $stmtAddress->fetch(PDO::FETCH_ASSOC)){
//   var_dump($addressList);
// };

// // var_dump($addressList['addressName']);

try {
  $addresses = getAddresses();
} catch (PDOException) {
  echo "Erreur lors de la récupération de vos adresses favorites";
  exit;
}

/* GESTION DES CATEGORIES */

require_once 'classes/Category.php';

// Je crée une instance de la classe Category en passant la connexion PDO
$category = new Category($pdo);

?>

<br>

<h2>Mes adresses</h2>

<div class="row row-cols-1 row-cols-md-2 g-4 p-4">
  <?php foreach ($addresses as $address) { ?>
    <div class="col">
      <div class="card h-100">
        <img src="uploads/<?php echo $address['picture']; ?>" class="card-img-top" alt="photo de l'établissement">
        <div class="card-body">

          <h5 class="card-title"><?php echo $address['addressName']; ?></h5>

          <?php if ($address['status_id'] === 1) { ?>
            <p class="card-text"><?php echo "À tester"; ?></p>
          <?php } else { ?>
            <p class="card-text"><?php echo "Testé & approuvé"; ?></p>
          <?php } ?>

          <?php
          $categoryByID = $category->getCategoryByID($address['category_id']);
          $categoryName = $categoryByID['name'];
          $categoryColor = $categoryByID['color']; ?>
          <p class="tag" style="background-color: <?php echo $categoryColor ?>"><?php echo $categoryName; ?></p>

          <p class="card-text"><?php echo $address['street']; ?></p>

          <p class="card-text"><?php echo $address['zipcode'] . " " . $address['city']; ?></p>

          <a href="addressDetails.php?id=<?php echo $address['id']; ?>">Voir plus</a>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php
require_once 'layout/footer.php';
