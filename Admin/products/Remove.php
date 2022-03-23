<?php 

   require '../helpers/DBConnection.php';
   require '../helpers/functions.php';

  $id = $_GET['id']; 

# select image Name .... 
$sql = "select image from articales where id = $id"; 
 $op  = doQuery($sql);
 $data = mysqli_fetch_assoc($op); 



  # Call DBRemove Method 
  $status = DBRemove('articales',$id); 


  if($status){

    unlink('uploads/'.$data['image']);
    
      $message = ["Message" => "Raw Removed"]; 
  }else{
    $message = ["Message" => "Error Try Again"]; 
  }

  $_SESSION['Message'] = $message; 

  header("Location: index.php");
?>