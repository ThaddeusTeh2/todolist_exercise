<?php

    //link to db
    $database = connectToDB();

    //declarations
    $email = $_POST['email'];
    $password = $_POST['password'];

    //checks if form is filled in
    if ( empty($email) || empty($password) ) {
      setError( "Please fill in all forms.", '/login' );

    //picks data from table from db
    } else {
        
        $sql = "SELECT * FROM users WHERE email = :email";
        
        $query = $database->prepare($sql);
        
        $query->execute([
            'email' => $email
        ]);
       
        $user = $query->fetch(); 
        
        //gets user info
        if ( $user ) {
            
            //checks if user info matches input
            if ( password_verify( $password, $user["password"] ) ) {
                
                $_SESSION['user'] = $user;

                header("Location: /");
                exit;  

              //tells u password is wrong
            } else {

              setError( "Incorrect password.", '/login' );

            }
            //if none of the above is satisfied print dis
        } else {
          setError( "This account is not registered.", '/login' );
        }

    }


    
    
    ?>

