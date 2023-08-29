<?php

function getDbConnection(): PDO
{
        $pdo = new PDO("mysql:dbname=carnet_adresse;host=host.docker.internal;port=3308;charset=utf8mb4", 'root', '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
        );
        return $pdo;
}