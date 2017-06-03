<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'abc';

    try{
        $conn = new PDO("mysql:host=$server;dbname=$db;", $user, $password);
    }catch(PDOException $e){
        die("Connection failed: " . $e->getMessage());
    }

?>