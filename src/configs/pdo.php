<?php

$db = 'mysql';
$dbHost = '127.0.0.1';
$dbName = 'karty_db';
$dbUser = 'karty_user';
$dbPass = 'karty_pass';

try {
    $dbConn = new PDO($db.':host=' . $dbHost . ';dbname=' . $dbName, $dbUser, $dbPass);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "ERROR => " . $error->getMessage();
}