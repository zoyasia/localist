<?php
require_once 'layout/header.php';

/* GESTION DES UTILISATEURS */

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

/* GESTION DES ADRESSES */

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
$categories = $category->getAllCategories();
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;


?>

<div>
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="landing-page.php">Voir tout</a>
    </li>

    <?php
    foreach ($categories as $cat) {
      echo '<li class="nav-item">';
      echo '<a class="nav-link ' . (($selectedCategory == $cat['id']) ? 'active' : '') . '" href="landing-page.php?category=' . $cat['id'] . '">' . $cat['name'] . '</a>';
      // echo '<a class="nav-link" href="landing-page.php?category=' . $cat['id'] . '">' . $cat['name'] . '</a>';
      echo '</li>';
    }
    echo '</ul>';

    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

    $sql = "SELECT * FROM addresses";

    if ($selectedCategory) {
      // Si une catégorie est sélectionnée, ajouter une clause WHERE pour filtrer par catégorie
      $sql .= " WHERE category_id = ?";
    }

    // Préparer la requête SQL
    $stmt = $pdo->prepare($sql);

    // Si une catégorie est sélectionnée, j'exécute la requête en passant la catégorie comme paramètre
    if ($selectedCategory) {
      $stmt->execute([$selectedCategory]);
    } else {
      // Sinon, j'exécute la requête sans paramètre pour afficher tout
      $stmt->execute();
    }

    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
