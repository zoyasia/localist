<?php
try {
    $pdo = new PDO("mysql:dbname=carnet_adresse;host=host.docker.internal;port=3308;charset=utf8mb4", 'root', '');
    var_dump($pdo);
} catch (PDOException) {
    echo "La connexion à la base de données a échoué";
    exit;
};


// $query= $pdo->query('SELECT * FROM addresses');
// var_dump($query);
// $ligne = $query->fetch(PDO::FETCH_ASSOC);
// var_dump($ligne);