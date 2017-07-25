<?php
//Sécurisation des données saisies pour l'inscription'
$nom = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'birthyear', FILTER_SANITIZE_NUMBER_INT);



// verification conformité année de naissance
          $agemin = date("Y")-10;
          if ($date < 1900 || $date > $agemin) {
            $age = date("Y")-$date;
// Messages d'erreur en fonction de l'age du participant (pour les petits malins et les - de 10 ans)
                if ($age > 110)
                    {
                      echo "Trop vieux pour participer à la course (110 max).<br/>";
                      echo "si vous vous êtes trompé d'année : <a href='?page=participation'>Réessayer</a></p>";
                    }
                else if ($age < 0)
                    {
                      echo " Je vois bien que vous êtes motivé mais vous n'êtes pas encore né !<br/>";
                      echo "si vous vous êtes trompé d'année : <a href='?page=participation'>Réessayer</a></p>";
                    }
                else if ($age < 10)
                  {
                      echo "Trop jeune pour participer à la course (10 ans min).<br/>";
                      echo "si vous vous êtes trompé d'année : <a href='?page=participation'>Réessayer</a></p>";
                  }
          }
          else {
              try {
                  include "controlleur.php";

/*-----------------------------------------------------------------------------------
      Insertion en BDD de la table Athlete
-----------------------------------------------------------------------------------*/
// Préparation d'insertion, création des marqueurs
                  $req = $bdd -> prepare (
                      'INSERT INTO '.$_SESSION['tableAthlete'].'(firstname, lastname, birthdate)
                      VALUES(:firstname, :lastname, :birthdate)');

// Tant que l'on n'a pas entré au moins une donnée, on ne peut pas créer une nouvelle fiche et le compteur de ticket ne s'incrémente pas
// Insert des data dans la table
                  if (isset($_POST['lastname'])) {
                      $req->bindParam(':firstname', $prenom);
                      $req->bindParam(':lastname', $nom);
                      $req->bindParam(':birthdate', $date);
                      // Execution des instructions
                      $req->execute();
                      echo "Votre inscription s'est bien déroulée.<br/>";
                      echo "Bonne chance ".$prenom." !";

                      $id_athlete = $bdd->lastInsertId();

                      // Incrémentation du ticket : 1 ticket par compte, tickets illimités par admin
                      $_SESSION['value']++;
                      $req2 = $bdd -> prepare('UPDATE user SET ticket=:valeur WHERE login =:username');
                      $req2->bindValue(':valeur', $_SESSION['value']);
                      $req2->bindValue(':username', $_SESSION['nomUser']);
                      $req2->execute();


/*-----------------------------------------------------------------------------------
      Insertion en BDD de la table RESULT
-----------------------------------------------------------------------------------*/
// Préparation d'insertion, création des marqueurs


                     $tempTime = 10;
                     $tempPoint = 0;

                      $req3 = $bdd -> prepare ( 'INSERT INTO '.$_SESSION['tableResultats'].'(meeting_id, athlete_id, time, points)
                                                 VALUES(:meeting_id, :athlete_id, :time, :points)');
                      $req3->bindParam(':meeting_id', $_SESSION['numCourse']);
                      $req3->bindParam(':athlete_id', $id_athlete);
                      $req3->bindParam(':time', $tempTime);
                      $req3->bindParam(':points', $tempPoint);
                      $req3->execute();


                  } // if ligne 44
              }
              catch (Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
          }
?>
