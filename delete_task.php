<?php

    //links db
    $host = '127.0.0.1';
    $database_name = "todoapp"; 
    $database_user = "root";
    $database_password = "";

    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password 
    );

    //declaration
    $id = $_POST["id"];

    echo $id;

    //poof
    $sql = "DELETE FROM tasks where id = :id";

    $query = $database->prepare( $sql );

    //exec
    $query->execute([
        "id" => $id
    ]);

    //redirect
    header("Location: index.php");
    exit;