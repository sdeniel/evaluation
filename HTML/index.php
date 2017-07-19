<?php
  session_start();
  //Informations d'entrées du serveur + base de données (+ table associée ?)
  $_SESSION['serveur'] = "localhost";
  $_SESSION['pseudo'] = "root";
  $_SESSION['pass'] = "Afp4S3b!";
  $_SESSION['baseDonnees'] = "evaluation";
  $_SESSION['tableLogin'] = 'user';
  $_SESSION['tableAthlete'] = 'athlete';

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Athletik - les 1000 pas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/main.css">
    <!-- jQuery library (served from Google) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- bxSlider Javascript file -->
    <script src="../bxslider/jquery.bxslider.min.js"></script>
    <!-- bxSlider CSS file -->
    <link href="../bxslider/jquery.bxslider.css" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js"></script>
	</head>

  <body>
    <?php
    // permet la gestion du session_start() sur cette seule page
    include "header.php";
    if (isset($_GET["page"])){
        switch ($_GET["page"]) {
            case $_GET["page"] : include $_GET["page"].".php";
            break;
            default : include "accueil.php";
        }
    }
    else include "accueil.php"
    ?>
  </body>

</html>
