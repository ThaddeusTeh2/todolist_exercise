<?php

    // 1. collect database info
    $host = '127.0.0.1';
    $database_name = "todoapp"; // connecting to which database 
    $database_user = "root";
    $database_password = "";

    // 2. connect to database (PDO - PHP database object)
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, // username
        $database_password // password
    );

    $id = $_POST["id"];

    echo $id;

    // sql command (recipe)
    $sql = "DELETE FROM tasks where id = :id";
    // prepare 
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
        "id" => $id
    ]);

    // redirect back to index.php
    header("Location: index.php");
    exit;