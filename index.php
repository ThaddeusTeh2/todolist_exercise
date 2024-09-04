<?php

//starts session
session_start();

  //links database to frontend
  $host ="127.0.0.1";
  $database_name = "todoapp";  
  $database_user = "root";
  $database_password = "";

   $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password
  );

 //picks table
  $sql = "SELECT * FROM tasks";

  $query = $database->prepare($sql); 

  $query->execute();
 //grabs data
  $tasks = $query->fetchAll();

  ?>




<!DOCTYPE html>
<html>
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


    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My To Do List</h3>
          
          <!--displays if logged in-->
          <?php if ( isset( $_SESSION['user'] ) ) : ?>
           <h4>Welcome back, <?= $_SESSION['user']['name']; ?>!</h4>
           <a href="logout.php">Logout</a>


        <ul class="list-group">
        <?php foreach ($tasks as $index => $label) : ?>

            <li class="list-group-item d-flex justify-content-between align-items-center">


            <!--CHECK-->

            <div>
              <form
                method="POST"
                action="check.php"
                >
                <input type="hidden" name="completed" value="<?= $label['completed']; ?>" />
                <input type="hidden" name="id" value="<?= $label['id']; ?>" />

                <?php if($label["completed"] == 0):?>


              <button class="btn btn-sm">
                <i class="bi bi-square"></i>
              </button>


            <?php else:?>
              <button class="btn btn-sm btn-success">
                <i class="bi bi-check-square"></i>
              </button>


            <?php endif;?>


              </form>



            </div>

            <div>
              <span> <?= $label["label"]; ?> </span>
            </div>

            <!--DELETE-->
            <div>
            <form
                method="POST"
                action="delete_task.php"
                >
                <input type="hidden" name="id" value="<?= $label['id']; ?>" />
                <button class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> </button>
              </form>
            </div>

            </li>
         <?php endforeach; ?>
        </ul>


        <div class="mt-4">
          <form method="POST" action="add_task.php"class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name = "new_task"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>

        <!--displays if not logged in-->

        <?php else : ?>
           <a href="login.php">Login</a>
           <a href="sign_up.php">Sign Up</a>
        <?php endif; ?>

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
