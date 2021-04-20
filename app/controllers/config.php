<?php 

    define('server', 'localhost');
    define('dbname', 'dbusermanagement');
    define('username', 'root');
    define('password', '');

    try{
        $dsn = 'mysql:host='.server.';dbname='.dbname;
        $pdo = new PDO($dsn, username, password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        die('Unable to connect ' .$e->getMessage());
    }

?>