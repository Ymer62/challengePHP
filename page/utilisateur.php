<?php
session_start();

include_once("connexion.php");



$username = isset($_POST['Username'])? $_POST['Username']:"";
echo $username."<br>";
$prenom = isset($_POST['prenom'])? $_POST['prenom']:"";
echo $prenom."<br>";
$file = $_POST['file'];
echo $file."<br>";
$jeux = isset($_POST['Game'])? $_POST['Game']:"";
echo $jeux."<br>";
$date = isset($_POST['date'])? $_POST['date']:"";
echo $date."<br>";
$mail = isset($_POST['email'])? $_POST['email']:"";
echo $mail."<br>";
$msg = isset($_POST['msg'])? $_POST['msg']:"";
echo $msg."<br>";
$file = $_FILES['file']['name'];
echo $file."<br>";


$toverif = [preg_match("#^[^0-9]#", $username),
           preg_match("#^[^0-9]+$#", $prenom),
           preg_match("#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#", $date),
           preg_match("#[a-zA-Z0-9]*@[a-zA-Z]*.[a-z]{2,4}#", $mail)];

           foreach ($toverif as $value) {
            if (!$value)
            {
              $match = false;
              break;
            }
            else {
              $match = true;
            }
           }

           if ($match==true) {
 echo "Contact envoyé";
 $insert = mysqli_query($cnx,"INSERT INTO utilisateur (username,prenom,file,jeux,date,mail,msg) VALUES ('".$username."','".$prenom."','".$file."','".$jeux."','".$date."','".$mail."','".$msg."')");
 $result = move_uploaded_file($_FILES['file']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/challengePHP/img/".$_FILES['file']['name']);
}
else {
 echo "Erreur";
}

echo '<br>';

if(is_dir('../img/')) {
    echo 'Le dossier existe';
} else {
    echo 'Le dossier n\'existe pas';
}

if((int)$insert==1){
  $_SESSION['contact']=true;
}
else{
  $_SESSION['contact']=false;
}

header("location:contact.php");
 ?>
