<? session_start(); ?>

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

    
    $host = '127.0.0.1';
    $database_name = "todoapp";  
    $database_user = "root";
    $database_password = "";

    
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user, 
        $database_password 
    );

    
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if ( empty( $email ) || empty( $password ) ) {

      echo '<div class="text-center">
      <h1>Please fill in all fields</h1>
      <a href="login.php" class="text-decoration-none">
      <i class="bi bi-arrow-left-circle"></i> Go back</a>
    </div>';

    } else {
        
        $sql = "SELECT * FROM users WHERE email = :email";
        
        $query = $database->prepare($sql);
        
        $query->execute([
            'email' => $email
        ]);
       
        $user = $query->fetch(); 
        
        
        if ( $user ) {
            
            if ( password_verify( $password, $user["password"] ) ) {
                
                $_SESSION['user'] = $user;

                header("Location: index.php");
                exit;  


            } else {

              echo '<div class="text-center">
              <h1>Incorrect password</h1>
              <a href="login.php" class="text-decoration-none">
              <i class="bi bi-arrow-left-circle"></i> Go back</a>
            </div>';

            }
        } else {
          echo '<div class="text-center">
          <h1>Account doesnt exist</h1>
          <a href="login.php" class="text-decoration-none">
          <i class="bi bi-arrow-left-circle"></i> Go back</a>
        </div>';
        }

    }


    
    
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>