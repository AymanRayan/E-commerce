<?php

require '../helpers/DBConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

$id = $_GET['id'];

$sql = "select image from users where user_id = $id";
$op  = doQuery($sql);
$data = mysqli_fetch_assoc($op);

$status = DBRemove('users', $id, 'user_id');


if ($status) {

  unlink('uploads/' . $data['image']);

  $message = ["Message" => "Raw Removed"];
} else {
  $message = ["Message" => "Error Try Again"];
}

$_SESSION['Message'] = $message;

header("Location: index.php");
