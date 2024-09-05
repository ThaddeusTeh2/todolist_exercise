<?php

// connect to database
function connectToDB() {
    // setup database credential
    $host = '127.0.0.1';
    $database_name = 'todoapp';
    $database_user = 'root';
    $database_password = '';

    // connect to the database
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );
    
    return $database;
}

function setError( $message, $redirect ) {
    $_SESSION['error'] = $message;
    header("Location: " . $redirect);
    exit;
}