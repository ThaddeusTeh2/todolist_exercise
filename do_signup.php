<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simple To Do App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
<body>
    
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

    //declarations

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //checks if all fields are filled in
    if ( empty( $name ) || empty( $email ) || empty( $password ) || empty( $confirm_password ) ) {
        echo '<div class="text-center">
          <h1>Please fill in all fields</h1>
          <a href="sign_up.php" class="text-decoration-none">
          <i class="bi bi-arrow-left-circle"></i> Go back</a>
        </div>';

    //checks if password and confim password are the same
    } else if ( $password !== $confirm_password ) {
        echo '<div class="text-center">
          <h1>Password must be the same</h1>
          <a href="sign_up.php" class="text-decoration-none">
          <i class="bi bi-arrow-left-circle"></i> Go back</a>
        </div>';
    
    //checks if password is atleast 8 letters long
    } else if ( strlen( $password ) < 8 ) { 

        echo '<div class="text-center">
          <h1>Password must be atleast 8 characters long</h1>
          <a href="sign_up.php" class="text-decoration-none">
          <i class="bi bi-arrow-left-circle"></i> Go back</a>
        </div>';

    }

        else {
          // check if the email already in-used or not
          // sql command
          $sql = "SELECT * FROM users WHERE email = :email";    
    
          //prepare
          $query = $database -> prepare($sql);
    
          // execute
          $query -> execute([
              'email' => $email
          ]);

        }
    
          // fetch
          $user = $query -> fetch(); //return the first row starting from the query row
    
          // if user exists, it means the email already in-used
          if ( $user ) {
            echo '<div class="text-center">
            <h1>Email already in use, try another</h1>
            <a href="sign_up.php" class="text-decoration-none">
            <i class="bi bi-arrow-left-circle"></i> Go back</a>
          </div>';
          }

    

    //if all the above is satisfied run dis
    else {

        $sql = "INSERT INTO users (`name`,`email`,`password`) VALUES (:name, :email, :password)";

        $query = $database->prepare( $sql );
        
        $query->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash ($password, PASSWORD_DEFAULT )
        ]);

        //sends user to login page
        header("Location: login.php");
        exit;
        
    }
    
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>