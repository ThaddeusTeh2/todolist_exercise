<?php

  //links db
  $database = connectToDB();

  $check = $_POST["completed"];
    $label = $_POST["id"];


  //if box not ticked, tick it
  if ( $check== 0) {
    $sql = "UPDATE tasks SET completed = 1 WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "id" => $label
    ]);

    header("Location: /");
    exit;
  }

  //if box ticked, untick it
  else {
    $sql = "UPDATE tasks SET completed = 0 WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
      "id" => $label
    ]);

    header("Location: /");
    exit;
  }



