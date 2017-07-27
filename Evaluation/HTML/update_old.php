<?php

$numCourse = $_GET['course'];
include "controlleur.php";

$req = $bdd -> prepare ('SELECT * FROM result WHERE meeting_id ='.$numCourse);
$req->execute();
$i = 0;
//while (
$donneesResult = $req->fetch();//)
//{

    // Les coureurs de la course selectionné sont selectionné 1 par 1
    $numCoureur = $donneesResult['athlete_id'];

    // on récupère les stats intrinsèques de chaque coureur $numCoureur
    $reponse = $bdd->prepare('SELECT athlete.*,result.time, result.points FROM athlete inner join result on athlete.id = result.id
                              WHERE result.id = :numresul OrDER BY result.points DESC');
    $reponse->bindValue(':numresul',$numCoureur);
    $reponse->execute();
    $donnees = $reponse->fetch();

///////
    $id[$i] = $donnees['id'];
    $etatCivil[$i] = $donnees['firstname'].' '.$donnees['lastname'];
    $age[$i] =  date("Y")-$donnees['birthdate'];
    $temps[$i] = $donnees['time'];
    $points[$i] = $donnees['points'];
    //$i++;
//}
$req->execute();
///////

  //for ($j = 0; $j < $i; $j++) {
    ?>
    <div class="test">
        <div>
            <form method = "post" class = "participant">
                <input type='hidden' id='idCoureur' value="<?php echo $id[$i];?>"/>
                <?php echo "<div>".$etatCivil[$i]."</div>"?>
                <input type='hidden' id='age' value="<?php echo $age[$i];?>"/>
                <input type="text" id="n1" name="chrono" value="<?php echo $temps[$i]; ?>" onchange ="calc()"/>
                <input type="text" name ="score" id="resultat" placeholder="nbPoints"/>
            </form>
       </div>
    </div>
    <!--?php
  }
    ?-->
    <input type="submit" name="validation" value="Envoi BDD" />

    <script>
    function calc() {
        var age = document.getElementById('age').value;
        var n1 = document.getElementById('n1').value;
        if (age == 10 || age == 11) {
          var coef = 1.5;
        }
        else if (age == 12 || age == 13) {
          var coef = 1.42;
        }
        else if (age == 14 || age == 15) {
          var coef = 1.35;
        }
        else if (age == 16 || age == 17) {
          var coef = 1.21;
        }
        else if (age == 18 || age == 19) {
          var coef = 1.18;
        }
        else if (age == 20 || age == 21 || age == 22) {
          var coef = 1.09;
        }
        else if (age > 22 && age <= 40) {
          var coef = 1;
        }
        else {
          var coef = 1.35;
        }
        var calcul = Math.round((1000/n1)*coef);
        document.getElementById('resultat').value = calcul;
        //console.log(age); console.log(n1); console.log(coef);// tests de variables
    }
    </script>
    <!--?php
    $i++;
}
$req->execute();
?-->

<?php
$tempsMAJ = filter_input(INPUT_POST, 'chrono', FILTER_SANITIZE_NUMBER_INT);
$pointsMAJ = filter_input(INPUT_POST, 'score', FILTER_SANITIZE_NUMBER_INT);

if(isset($_POST['validation'])) {

       $modif = $bdd->prepare("UPDATE result SET   time =:time,
                                                   points =:points
                                             WHERE id =:id");

      //  ('SELECT athlete.*,result.time, result.points FROM athlete inner join result on athlete.id = result.id
      //                            WHERE result.id = :numresul OrDER BY result.points DESC');

       $modif->bindParam(':time', $tempsMAJ);
       $modif->bindParam(':points', $pointsMAJ);
       $modif->bindParam(':id', $id[0]);

       echo " HELLO";
    //if (!empty($points[0])) {
          $modif->execute();
          //header('Location: accueil.php');
          echo " on y est !<br/>";
      //}
}

 ?>



 <!--?php
 $numCourse = 2; // mano
 $htemp = 1;//$_POST['chrono'];
 $hpoint = 1;//$_POST['points'];

  $reqEnvoi = $bdd -> prepare ( 'INSERT INTO '.$_SESSION['tableResultats'].'(meeting_id, athlete_id, time, points)
                                 VALUES(:meeting_id, :athlete_id, :time, :points)');
  $reqEnvoi->bindParam(':meeting_id', $numCourse);
  $reqEnvoi->bindParam(':athlete_id', $idcoureur);
  $reqEnvoi->bindParam(':time', $htemp);
  $reqEnvoi->bindParam(':points', $hpoint);
  $reqEnvoi->execute();
 ?-->
 <br/><a href="?page=resultats">Retour aux modifications</a>
