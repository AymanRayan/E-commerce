<?php 

   require '../helpers/DBConnection.php';
   require '../helpers/functions.php';

  $id = $_GET['id']; 

  # Call DBRemove Method 
  $status = DBRemove('roles',$id,'role_id'); 


  if($status){
      $message = ["Message" => "Raw Removed"]; 
  }else{
    $message = ["Message" => "Error Try Again"]; 
  }

  $_SESSION['Message'] = $message; 

  header("Location: index.php");
?>