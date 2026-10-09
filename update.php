<?php include('dbconnection.php'); ?>
<?php

  if (isset($_POST['update'])){
    if(isset($_GET['id_new'])){
      $idnew = (int) $_GET['id_new'];
    }

    $firstName= $_POST['firstName'];
    $lastName= $_POST['lastName'];
    $age= $_POST['age'];

    $query="update `students` set `firstName` = '$firstName', `lastName` = '$lastName', `age` = '$age' where `id`='$idnew'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("query Failed".mysqli_error($connection));
    } else {
      header('location:index.php?update_msg=You have successfully updated the data.');
      exit;
    }
  }

?>
<?php include('header.php'); ?>

          <?php

            if (isset($_GET['id'])){
              $id = (int) $_GET['id'];

              $query = "SELECT * FROM `students` where `id` = '$id'";
              $result = mysqli_query($connection, $query);
              if (!$result) {
                die("query Failed");
              } else {
                $row= mysqli_fetch_array($result);
                
              }
            }




          ?>


          <form action="update.php?id_new=<?php echo $id; ?>" method="post">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" name="firstName" id="firstName" class="form-control" value="<?php echo htmlspecialchars($row['firstName']); ?>">
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" name="lastName" id="lastName" class="form-control" value="<?php echo htmlspecialchars($row['lastName']); ?>">
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="text" name="age" id="age" class="form-control" value="<?php echo htmlspecialchars($row['age']); ?>">
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="update" value="UPDATE"></input>
          </form>



<?php include('footer.php'); ?>