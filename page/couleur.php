<?php

session_start();

include_once("connexion.php");

$titre = isset($_POST['couleurtitre'])? $_POST['couleurtitre']:"";

$bar = isset($_POST['navbar'])? $_POST['navbar']:"";

$urls = isset($_POST['urls'])? $_POST['urls']:"";

$bouton = isset($_POST['bouton'])? $_POST['bouton']:"";

if($titre !=''){
$res2 = mysqli_query($cnx,"UPDATE couleur SET titre='$titre' WHERE id=1");
}
if($bar !=''){
$res2 = mysqli_query($cnx,"UPDATE couleur SET navbar='$bar' WHERE id=1");
}
if($urls !=''){
$res2 = mysqli_query($cnx,"UPDATE couleur SET urls='$urls' WHERE id=1");
}
if($bouton !=''){
$res2 = mysqli_query($cnx,"UPDATE couleur SET bouton='$bouton' WHERE id=1");
}

$inp = isset($_POST['inp'])? $_POST['inp']:"";

if($inp !=''){
$res2 = mysqli_query($cnx,"UPDATE couleur SET carou=$inp WHERE id=1");
}




header('location:admin.php');

 ?>
