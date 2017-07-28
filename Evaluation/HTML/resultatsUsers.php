<?php
//$consultCourse = new ResultatsUsers;
//$consultCourse->consultationResultatsf();

// RESULTATS + CLASSEMENT
  echo "<div class='resultatClassement'><div class='ole'>";

  // Résultats
    $reponseResult = $bdd->prepare("SELECT athlete.*, result.time, result.points  FROM athlete inner join result on athlete.id = result.id WHERE result.meeting_id =1 ORDER BY firstname ASC");
    $reponseResult->execute(array());
    echo "<h3>Resultats de la dernière course</h3>";
    while ($donneesResult = $reponseResult->fetch())
    {
      echo "<div class='test'><div><div>".$donneesResult['firstname']." ";
      echo $donneesResult['lastname']."</div></div><div><div>";
          $age = date("Y")-$donneesResult['birthdate'];
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
      echo "</div></div><div><div>".$donneesResult['points']." points</div></div></div>";
    }
    echo "</div><div class='podium'><h3>Classement Général</h3>";
//******************************************************************************************************************

//******************************************************************************************************************
  // classement
    $reponseClass = $bdd->prepare("SELECT SUM(result.points) as total, athlete.lastname, athlete.firstname FROM result inner join athlete on result.athlete_id = athlete.id inner join meeting on result.meeting_id = meeting.id WHERE YEAR(CURRENT_DATE()) = 2017 GROUP BY athlete.id ORDER BY total DESC ");
    $reponseClass->execute(array());
    $i = 1;
    while ($donneesClass = $reponseClass->fetch())
    {
      echo "<div class='test2'><div>".$i." : ".$donneesClass['firstname']." ";
      echo $donneesClass['lastname']."</div></div>";
      $i++;
    }
    echo "</div>";
 ?>
