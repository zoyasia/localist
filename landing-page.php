<?php
require_once __DIR__ . '/layout/header.php';

/* GESTION DES UTILISATEURS */

if (isset($_SESSION['user_id'])) {
  require_once __DIR__ . '/functions/db.php';

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

require_once __DIR__ . '/classes/Category.php';

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



    $sql = "SELECT * FROM addresses WHERE user_id = ?";

    // Si une catégorie est sélectionnée, je filtre les adresses pour ne renvoyer que cette catégorie
    if ($selectedCategory) {
      $sql .= " AND category_id = ?";
    }

    $stmt = $pdo->prepare($sql);

    // j'initialise un tableau où stocker les paramètres nécessaires à ma requête SQL
    $params = [$user_id];

    // Si une catégorie est sélectionnée, j'ajoute la catégorie aux paramètres
    if ($selectedCategory) {
      $params[] = $selectedCategory;
    }

    $stmt->execute($params);

    // VERSION NON FONCTIONNELLE
    // $sql = "SELECT * FROM addresses";
    // if ($selectedCategory) {
    //   $sql .= " WHERE category_id = ?";
    // }
    // $stmt = $pdo->prepare($sql);
    // if ($selectedCategory) {
    //   $stmt->execute([$selectedCategory]);
    // } else {
    //   $stmt->execute();
    // }

    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <br>
    <h2>Mes adresses</h2>
    <br>

    <?php if (empty($addresses)) { ?>
      <div>
        <a href="#">J'ajoute ma première adresse !</a>
      </div>
    <?php } else { ?>

      <div class="row row-cols-1 row-cols-md-2 g-4 p-4">
        <?php foreach ($addresses as $address) { ?>
          <div class="col-md-4">
            <div class="card mb-4 h-100">

              <?php if (!empty($address['picture'])) { ?>
                <img src="uploads/<?php echo $address['picture']; ?>" class="card-img-top img-fluid" alt="photo de l'établissement">
              <?php } ?>
              
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
    <?php }


    require_once __DIR__ . '/layout/footer.php';
