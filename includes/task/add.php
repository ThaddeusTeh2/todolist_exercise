<?php
  //links to db
  $database = connectToDB();

  $sql = "SELECT * FROM tasks";

  $query = $database->prepare($sql); 

  $query->execute();

  $tasks = $query->fetchAll();


  
  $label = $_POST["new_task"];

  if ( empty( $label ) ) {
    setError( "Please add something.", '/home' );
} else {

    $sql = 'INSERT INTO tasks (`label`) VALUES (:label)';

    $query = $database->prepare( $sql );

    $query->execute([
        'label' => $label
    ]);
    
    header("Location: /");
    exit;
}