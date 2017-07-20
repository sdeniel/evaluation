<?php
try {
    $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $reponseResult = $bdd->prepare("SELECT athlete.*, result.time, result.points  FROM athlete inner join result on athlete.id = result.id WHERE result.meeting_id =1 ORDER BY firstname ASC");
    $reponseResult->execute(array());
    echo "<h3>Resultats de la course</h3>";
    $i=0;
    while ($donnees = $reponseResult->fetch())
    {
        $age = date("Y")-$donnees['birthdate'];
        switch ($age) {
          case 10 : case 11 :
              echo "Poussin";
              break;
          case 12 : case 13 :
              echo "Benjamin";
              break;
          case 14 : case 15 :
              echo "Minime";
              break;
          case 16 : case 17 :
              echo "Cadet";
              break;
          case 18 : case 19 :
              echo "Junior";
              break;
          case 20 : case 22 :
              echo "Espoir";
              break;
          case 23 : case 40 :
              echo "Sénior";
              break;
          default :
              echo "Master";
        }
      //  $tab[$i] = array("name" => $donnees['birthdate']);
    }
}
catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}


?>
