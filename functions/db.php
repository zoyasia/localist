<?php

function getDbConnection(): PDO
{
    // je décompose mon fichier db.ini
    $dbSettings = parse_ini_file(__DIR__ . '/../db.ini');
    [
        'DB_HOST' => $dbHost,
        'DB_PORT'=> $dbPort,
        'DB_NAME'=> $dbName, 
        'DB_CHARSET'=> $dbCharset,
        'DB_USER' => $dbUser,
        'DB_PASSWORD' => $dbPassword
    ] = $dbSettings;

        $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=$dbCharset", $dbUser, $dbPassword,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
        );
        return $pdo;
}