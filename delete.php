<?php
require_once 'functions/db.php';

if (isset($_GET['did'])) {
    $delete_id = $_GET['did'];

    try {
        $pdo = getDbConnection();

        // Utilisez une requête préparée pour la suppression
        $stmt = $pdo->prepare("DELETE FROM addresses WHERE id = :id");

        // Exécutez la requête préparée en spécifiant les valeurs des paramètres dans un tableau
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
