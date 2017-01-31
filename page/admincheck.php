<?php

session_start();

include_once("connexion.php");


$username = isset($_POST['username'])? $_POST['username']:"";

$password = isset($_POST['password'])? $_POST['password']:"";


$username = mysqli_real_escape_string($cnx,$username);
$password = mysqli_real_escape_string($cnx,$password);

$res = mysqli_query($cnx,"SELECT * FROM challenge WHERE username='".$username."' AND password='".$password."'");
$_SESSION['data'] = mysqli_fetch_assoc($res);


if($_SESSION['data']){
  $_SESSION['login1']=true;
}
else{
  $_SESSION['login1

  ']=false;
}

header("location:admin.php");
 ?>
