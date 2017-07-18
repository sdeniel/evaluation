<?php
 session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Accueil</title>
		<link rel="stylesheet" type="text/css" href="../CSS/main.css">
    <!-- jQuery library (served from Google) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- bxSlider Javascript file -->
    <script src="../bxslider/jquery.bxslider.min.js"></script>
    <!-- bxSlider CSS file -->
    <link href="../bxslider/jquery.bxslider.css" rel="stylesheet" />
	</head>

	<body>
      <?php include "header.php"; ?>
      <div class="contenu">
          <div class="presAsso">
              <?php include "presentation.php"; ?>
          </div>
          <div class="divAside">
              <div class="carousel">
                  <ul class="bxslider">
                      <li><img src="../IMG/photo1.jpg" /></li>
                      <li><img src="../IMG/photo2.jpg" /></li>
                      <li><img src="../IMG/photo3.jpg" /></li>
                      <li><img src="../IMG/photo4.jpg" /></li>
                      <li><img src="../IMG/photo5.jpg" /></li>
                  </ul>
              </div>
              <div class="news">
                  <?php include "new.php"; ?>
              </div>
          </div>
      </div>

      <!-- TUTO carousel : http://bxslider.com/ -->
      <script type="text/javascript">
      $('.bxslider').bxSlider({
auto: true,
autoControls: true
});
      </script>
	</body>
</html>
