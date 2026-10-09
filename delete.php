<?php include('header.php'); ?>
<?php include('dbconnection.php'); ?>

<?php
  if(isset($_GET['id'])){
      $id = $_GET['id'];
  

    $query = "delete from `students` where `id` = '$id'";
    $result= mysqli_query($connection,$query);
    if(!$result){
      die("Query Failed".mysqli_error($connection));
    } else{
      header('location:index.php?delete_msg=You have deleted the record.');
    }
  }
?>



<?php include('footer.php'); ?>