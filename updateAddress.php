<?php
require_once 'layout/header.php';

// je récupère à l'aide de la superglobale $_GET l'id envoyé dans l'url depuis la carte adresse sur landing-page

$id = $_GET['id'] ?? null;

if ($id === null) {
  echo "Merci de préciser un id";
  exit;
}

require_once 'functions/db.php';

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


/*
1- dans le lien "Modifier", insérer un $_GET pour récup l'id de l'adresse à modifier
2- récupérer cet id sur cette page
3- Etablir la connexion à la bdd avec un try catch
4- reprendre le formulaire newAddress
Insérer la précédente valeur connue dans le placeholder ?
5- bouton valider modifie la base de données: écrase si le champs est rempli, si aucune donnée n'est entrée dans un champs, alors on conserve la donnée précédemment connue.
*/

  ?>

<!--Formulaire modification adresse -->
<form action="" method="POST" enctype='multipart/form-data'>
    <h1>
        <input type="text" name="name" placeholder="<?php echo $addressDetail['addressName']; ?>">
    </h1>"

</form>


