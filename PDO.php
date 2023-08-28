<?php
try {
    $pdo = new PDO("mysql:dbname=carnet_adresse;host=host.docker.internal;port=3308;charset=utf8mb4", 'root', '');
    var_dump($pdo);
} catch (PDOException) {
    echo "La connexion à la base de données a échoué";
    exit;
};

