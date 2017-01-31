<?php
session_start();

include_once("connexion.php");

$res5 = mysqli_query($cnx,"SELECT * FROM utilisateur ");

if($_SESSION['data']){
  $_SESSION['login']=true;
}
else{
  $_SESSION['login']=false;
}

$res2 = mysqli_query($cnx,"SELECT * FROM couleur WHERE id=1");
$data2= mysqli_fetch_assoc($res2);

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <title>admin</title>
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
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Start Bootstrap</a>
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
                    <?php   if($_SESSION['login1']==true){echo  '<li><a href="admin.php">'.$_SESSION['data']['first_name'].'</a></li>'; }
                            else{echo  '<li><a href="admin.php">Administration</a></li>';}   ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div class="container">
<div class="row">

<?php
if(isset($_SESSION['login']) && $_SESSION['login']==true){
  echo "<br>";

  echo "<div col-md-12' >";

  echo '<pre>';

  echo "<div class='formu col-md-7'>";

  echo '<h2>Espace Administrateur : </h2><br>';

  echo "<p class='pres'>vous etes connecter!!!</p><br>";

  echo "<p class='pres'>bonjour, Monsieur ".$_SESSION['data']['first_name']."</p><br><br>";

  echo "<form action='couleur.php' method='post'><input type='text' id='coultitre' name='couleurtitre' placeholder='couleur'><input type='submit' onClick='couleur()' value='Couleur des titres'></form><br>";

  echo "<form action='couleur.php' method='post'><input type='text' name='navbar' id='coulbar' placeholder='couleur'><input type='submit' value='La couleur de la navbar'></form><br>";

  echo "<form action='couleur.php' method='post'><input type='text' name='urls' id='coulurls' placeholder='couleur'><input type='submit' value='La couleur des urls'></form><br>";

  echo "<form action='couleur.php' method='post'><input type='text' name='bouton' id='coulbout' placeholder='couleur'><input type='submit' value='La couleur des boutons'></form><br>";

  echo "<form action='couleur.php' method='post'>Voulez vous avoir les fleches du carousel : Oui :<input name='inp' type='radio' value=1> / Non :<input name='inp' type='radio' value=0>   <input type='submit' value='GO'></form><br>";

  echo "<pre><form action='destroy.php'><input type='submit' class='deco' value='Deconnexion'></form></pre>";

  echo "</div>";

  echo "<div class='formu col-md-5'>";

  echo  "<h2>Historique couleurs : </h2>";

  echo "<div id='histodiv'>";


  echo "</div>";

  echo "</div>";

  echo '</pre>';

  echo '</div>';

  echo "<div class='col-md-12'>";

  echo '<h2> Utilisateurs </h2>';
         echo'<table><th>id</th><th>Pseudo</th><th>Prenom</th><th>Photo</th><th>Jeux</th><th>Naissance</th><th>E-mail</th><th>Msg</th>';
         while ($data5 = mysqli_fetch_assoc($res5)){
           echo '<tr>';
         foreach($data5 as $key=>$value){
           if($key != 'file'){
             echo '<td>'.$value.'</td>';
           }
           else{
             echo '<td><img src="../img/'.$value.'"></td>';
           }
         }
         echo'</tr>';
         }
         echo '</table>';

           echo '</div>';
  }
  else{
    echo "<br>";

    echo "<div class='formu col-md-12' >";

    echo '<pre>';

     echo		'<form action="admincheck.php" method="post"><br>';

     echo   '<h1>Espace Administration : </h1><br><br>';

     echo 	'<input type="text" name="username" placeholder="Username"><br><br>';

     echo		'<input type="password" name="password" placeholder="Mot de passe"><br><br>';

     echo		'<input type="submit" value="Login">';

     echo		'</form>';

    echo '</pre>';

    echo '</div>';

  }


 ?>

</div>
</div>


  <div class="container">
    <!-- Footer -->
    <footer>
        <div class="row">
          <div class="col-lg-6">
              <p>Copyright &copy; SimplonBSM 2017</p>
          </div>
          <div class="col-lg-6 rigth">
            <a href="#" class="go_top">GoToTop</a>
          </div>
        </div>
    </footer>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

  </body>
</html>
