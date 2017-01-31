<?php
session_start();

include_once("connexion.php");

$res5 = mysqli_query($cnx,"SELECT *
FROM utilisateur
ORDER BY id DESC
LIMIT 1");
$data5 = mysqli_fetch_assoc($res5);

if($_SESSION['data']){
  $_SESSION['login']=true;
}
else{
  $_SESSION['login']=false;
}

$res2 = mysqli_query($cnx,"SELECT * FROM couleur WHERE id=1");
        $data2= mysqli_fetch_assoc($res2);

$res3 = mysqli_query($cnx,"SELECT * FROM utilisateur");
        $data3 = mysqli_fetch_assoc($res3);

        $username = isset($_POST['Username'])? $_POST['Username']:"";

        $prenom = isset($_POST['prenom'])? $_POST['prenom']:"";

        $file = $_POST['file'];

        $jeux = isset($_POST['Game'])? $_POST['Game']:"";

        $date = isset($_POST['date'])? $_POST['date']:"";

        $mail = isset($_POST['email'])? $_POST['email']:"";

        $msg = isset($_POST['msg'])? $_POST['msg']:"";

        $file = $_FILES['file']['name'];



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
         echo "";
        }

        if((int)$insert==1){
          $insert1=true;
        }
        else{
          $insert1=false;
        }

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Challenge PHP de </title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
      h1,h2,h3,h4,h5{
        color:<?php echo $data2['titre']; ?>!important;
      }

      nav{
        background-color: <?php echo $data2['navbar']; ?>!important;
      }

      a{
        color: <?php echo $data2['urls']; ?>!important;
      }

      input{
        background-color: <?php echo $data2['bouton']; ?>!important;
      }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Left -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span><!--anti curseur clignotant-->
                    <span class="icon-bar"></span><!--anti curseur clignotant-->
                    <span class="icon-bar"></span><!--anti curseur clignotant-->
                </button>
                <a class="navbar-brand" href="../index.html">Start Bootstrap</a>
            </div>
            <!-- Right -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li>
                        <a href="repertory.php">Repertory</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <?php   if($_SESSION['login']==true){echo  '<li><a href="admin.php">'.$_SESSION['data']['first_name'].'</a></li>'; }
                            else{echo  '<li><a href="admin.php">Administration</a></li>';}   ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Contact</h1>
                <ol class="breadcrumb">
                    <li><a href="../index.php">Home</a>
                    </li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Form Column -->
            <div class="col-md-4">
              <?php if($insert1==true){echo '<pre>vous vous etes bien enregistrer : '.$data5['prenom'].'</pre>';$_SESSION['expires_on']=time(3)+INACTIVITY_TIMEOUT;}
                    elseif ($insert1==false){echo "";}
               ?>
                <!-- Contact form -->
                <form  action="contact.php" enctype="multipart/form-data" name="sentMessage" method="post">
                  <div class="control-group form-group">
                      <div class="controls">
                          <label>Username:</label>
                          <input type="text" class="form-control" name="Username" placeholder="Entrer votre Pseudo : ">
                      </div>
                  </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Prenom:</label>
                            <input type="text" class="form-control" name="prenom" placeholder="Entrer votre Prenom : " required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                     <div class="control-group form-group">
                         <div class="controls">
                             <label>Jeux:</label>
                             <input type="text" class="form-control" placeholder="Entrer votre jeux préférer : " name="Game" >
                             <p class="help-block"></p>
                         </div>
                     </div>
                     <div class="control-group form-group">
                         <div class="controls">
                             <label>Date de naissance:</label>
                             <input type="time" class="form-control" placeholder="Entrer votre date de naissance(JJ/MM/AAAA) : " name="date" >
                             <p class="help-block"></p>
                         </div>
                     </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Adresse Email:</label>
                            <input type="email" class="form-control" placeholder="Entrer votre E-mail : " name="email" >
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="4" cols="100" class="form-control" placeholder="Entrer un message(Optionnel) : " name="msg" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Photo de profil:</label>
                            <input type="file"  name="file">
                        </div>
                     </div>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>Copyright &copy; SimplonBSM 2017</p>
                </div>
                <div class="col-lg-6 rigth">
                  <a href="#" class="go_top">GoToTop</a><!--anti curseur clignotant-->
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>

<?php ?>
