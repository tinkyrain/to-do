<?php 
    $driver = 'mysql';
    $host = 'localhost';
    $db_name = 'to-do';
    $db_user = 'root';
    $db_password = '';
    $charset = 'utf8';

    try{
        $dsn = "$driver:host=$host;dbname=$db_name;charset=$charset";
        $pdo = new PDO($dsn, $db_user, $db_password);
    } catch(PDOException $e) {
        die("Failed to connect to database");
    }
?>