<?php include('header.php'); ?>
<?php include('dbconnection.php'); ?>

  <div class="box1">
    <h2>ALL STUDENTS</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD STUDENT</button>
  </div>
  <table class="table table-hover table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Age</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM `students`";
      $result = mysqli_query($connection, $query);
      if (!$result) {
        die("query Failed");
      } else {
        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['firstName']; ?></td>
            <td><?php echo $row['lastName']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
          </tr>

          <?php
        }
      }
      ?>
    </tbody>
  </table>

  <?php

  if(isset($_GET['message'])) {
    echo "<h6>".$_GET['message']."</h6>";
  }

  ?>

  <?php

  if(isset($_GET['insert_msg'])) {
    echo "<h5>".$_GET['insert_msg']."</h5>";
  }

  ?>

  <?php

  if(isset($_GET['update_msg'])) {
    echo "<h5>".$_GET['update_msg']."</h5>";
  }

  ?>

  <?php

  if(isset($_GET['delete_msg'])) {
    echo "<h6>".$_GET['delete_msg']."</h6>";
  }

  ?>



  <form action="insert_data.php" method="post">
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD STUDENT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" name="firstName" id="firstName" class="form-control">
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" name="lastName" id="lastName" class="form-control">
            </div>
            <div class="mb-3">
              <label for="age" class="form-label">Age</label>
              <input type="text" name="age" id="age" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="addStudent" value="ADD"></input>
        </div>
      </div>
    </div>
  </div>
  </form>


<?php include('footer.php'); ?>