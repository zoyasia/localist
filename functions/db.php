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

    $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=$dbCharset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try{
        $pdo = new PDO($dsn, $dbUser, $dbPassword, $options);
    }catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    return $pdo;
    }


    function getAddresses(): array
    {
      $pdo = getDbConnection();
      $user_id = $_SESSION['user_id'];
      $stmtAddress = $pdo->prepare("SELECT * FROM addresses WHERE user_id = ?");
      $stmtAddress->execute([$user_id]);

      while ($addressList = $stmtAddress->fetchAll()){
        return($addressList);
      };
    }    