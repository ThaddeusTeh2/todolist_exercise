<?php

  
  // connect to the database
  $database = connectToDB();

 //picks table
  $sql = "SELECT * FROM tasks";

  $query = $database->prepare($sql); 

  $query->execute();
 //grabs data
  $tasks = $query->fetchAll();

  ?>

<?require "parts/header.php"?>

<!--content-->
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My To Do List</h3>
          
          <!--displays if logged in-->
          <?php if ( isset( $_SESSION['user'] ) ) : ?>
           <h4>Welcome back, <?= $_SESSION['user']['name']; ?>!</h4>
           <a href="/logout">Logout</a>


        <ul class="list-group">
        <?php foreach ($tasks as $index => $label) : ?>

            <li class="list-group-item d-flex justify-content-between align-items-center">


            <!--CHECK-->

            <div>
              <form
                method="POST"
                action="/task/update"
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
                action="/task/delete"
                >
                <input type="hidden" name="id" value="<?= $label['id']; ?>" />
                <button class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i> </button>
              </form>
            </div>

            </li>
         <?php endforeach; ?>
        </ul>


        <div class="mt-4">
          <form method="POST" action="/task/add"class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name = "new_task"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>

        <? require "parts/error_box.php"?>

        <!--displays if not logged in-->

        <?php else : ?>
           <a href="/login">Login</a>
           <a href="/signup">Sign Up</a>
        <?php endif; ?>

      </div>
    </div>

<? require "parts/footer.php"?>
