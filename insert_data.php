<?php
include('dbconnection.php');

if (isset($_POST["addStudent"])) {
  
  $firstName=$_POST["firstName"];
  $lastName=$_POST["lastName"];
  $age=$_POST["age"];

  if($firstName == '' || empty($firstName)){
    header('location:index.php?message=You need to fill the first name!');
    exit;
  }
  else{
    $query = "insert into `students` (`firstName`,`lastName`,`age`) values ('$firstName','$lastName','$age')";
    $result = mysqli_query($connection,$query);

    if(!$result){
      die("Query Failed".mysqli_error($connection));
    }
    else{
      header('location:index.php?insert_msg=Your data has been added successfully!');
      exit;
    }
  }
}