<?php 
   
   if(!isset($_SESSION['user'])){
       header("Location: ".Url('login.php'));
       exit();
   }


?>