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

  $check = $_POST["completed"];
    $label = $_POST["id"];



  if ( $check== 0) {
    $sql = "UPDATE tasks SET completed = 1 WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "id" => $label
    ]);

    header("Location: index.php");
    exit;
  }

  else {
    $sql = "UPDATE tasks SET completed = 0 WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "id" => $label
    ]);

    header("Location: index.php");
    exit;
  }



