<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/functions/db.php';

if (isset($_GET['did'])) {
    $delete_id = $_GET['did'];

    try {
        $pdo = getDbConnection();

        $stmt = $pdo->prepare("DELETE FROM addresses WHERE id = :id");
        
        $result = $stmt->execute(['id' => $delete_id]);

        if ($result !== false) {
            echo "<br/><br/><p class=\"success\">L'adresse a été correctement supprimée</p>";
        } else {
            echo "ERREUR";
        }
    } catch (PDOException) {
        http_response_code(500);
        echo "La connexion à la base de données a échoué";
        exit;
    }
}
?>

<a href="<?php echo '/landing-page.php' ?>">Retour aux adresses enregistrées</a>