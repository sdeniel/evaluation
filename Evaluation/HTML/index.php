<?php
  session_start();
  //Declaration des variables que l'on réutilisera tout au long du code
  // constante a mettre dans fichier de config.inc (methode DEFINE)
  $_SESSION['serveur'] = "localhost";
  $_SESSION['pseudo'] = "root";
  $_SESSION['pass'] = "Afp4S3b!";
  $_SESSION['baseDonnees'] = "evaluation";
  $_SESSION['tableLogin'] = 'user';
  $_SESSION['tableAthlete'] = 'athlete';
  $_SESSION['tableCourse'] = 'meeting';
  $_SESSION['tableResultats'] = 'result';
  // Temporaire on choisit la 2nd course :
  $_SESSION['nomCourse'] = 'Troufaillon Les oies';
  $_SESSION['numCourse'] = 2;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Athletik - les 1000 pas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/main.css">
    <!-- jQuery : nous sert pour le carousel -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- bxSlider : notre carousel -->
    <script src="../bxslider/jquery.bxslider.min.js"></script>
    <link href="../bxslider/jquery.bxslider.css" rel="stylesheet" />
    <!-- Notre captcha google -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
	</head>

  <body>
    <?php
    // permet la gestion d'un seul session_start(). Plus propre et plus sain qu'un par page.
    include "header.php";
    if (isset($_GET["page"])){
        switch ($_GET["page"]) {
            case $_GET["page"] : include $_GET["page"].".php";
            break;
            default : include "accueil.php";
        }
    }
    else include "accueil.php";
    ?>
  </body>

</html>
