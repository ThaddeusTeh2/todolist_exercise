<?php

    //links db
    $database = connectToDB();

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
    header("Location: /");
    exit;