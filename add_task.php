<?php
  $host ="127.0.0.1";
  $database_name = "todoapp";
  $database_user = "root";
  $database_password = "";

   $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );

  $sql = "SELECT * FROM tasks";

  $query = $database->prepare($sql); 

  $query->execute();

  $tasks = $query->fetchAll();


  
  $label = $_POST["new_task"];

  if ( empty( $label ) ) {
    echo "Please add a task.";
} else {

    $sql = 'INSERT INTO tasks (`label`) VALUES (:label)';

    $query = $database->prepare( $sql );

    $query->execute([
        'label' => $label
    ]);
    
    header("Location: index.php");
    exit;
}