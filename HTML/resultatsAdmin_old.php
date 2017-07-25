<div class = "modeAdmin">
    <div class = "modeAdminform">
        <h3>Ajouter une course</h3>

        <form method="POST" action="#">
            <input type="text" name="addLieu" placeholder="Lieu" required/>
            <input type="text" name="addDescription" placeholder="Description"/>
            <input type="date" name="addDate" placeholder="Date : aaaa-mm-jj" required/>
            <input type="submit" name="ok" value="ok" />
        </form>

        <?php
        include "controlleur.php";

        if(isset($_POST))
            {
          // AJOUT D'UNE NOUVEAU COURSE
            $req = $bdd -> prepare ('INSERT INTO '.$_SESSION["tableCourse"].'(name, description, date)
                                     VALUES(:name, :description, :date)');

            $addLieu = filter_input(INPUT_POST, 'addLieu', FILTER_SANITIZE_STRING);
            $addDescription = filter_input(INPUT_POST, 'addDescription', FILTER_SANITIZE_STRING);
            $addDate = filter_input(INPUT_POST, 'addDate', FILTER_SANITIZE_NUMBER_INT);

            $req->bindParam(':name', $addLieu);
            $req->bindParam(':description', $addDescription);
            $req->bindParam(':date', $addDate);
            // On execute le code uniquement si au moins le lieu est rempli (la date est required too) pour ne pas avoir une course vide
            if (!empty($addLieu)) {
                $req->execute();
            }

          }
        ?>
    </div>
    <div class ="modeAdminTab">
        <h3>Entrer les temps des participants</h3>


<!--/*******************************************************************************/

/*******************************************************************************/-->
        <!-- Liste des Courses de 2017, parcours des courses (dans la table de la BDD) -->

        <select id="selectionCourse" onchange="choixCourse();">
            <option value= "none">Choix de la course</option>";
            <?php
                $reponseCourse = $bdd->prepare("SELECT * FROM meeting WHERE YEAR(meeting.date) = 2017");
                $reponseCourse->execute(array());
                    while ($donnees = $reponseCourse->fetch())
                    {
                      echo "\t",'<option value="', $donnees['id'] ,'"' ,'>', $donnees['name'] ,'</option>',"\n";
                    }
                echo '</select>';
          ?>
        <script>
            function choixCourse() {
                var $course = document.getElementById('selectionCourse').value;
                document.getElementById('numCourse').innerHTML = "course num : " + $course;
            }
        </script>
        <p id = "numCourse"></p>

<!--/*******************************************************************************/

/*******************************************************************************/
        // Liste des participants de la course selectionnée-->
        <select id="selectionCoureur" onchange="choixCoureur();">
            <option value= "none">Choix du coureur</option>";
            <?php
                $reponseCoureur = $bdd->prepare("SELECT * FROM athlete");// WHERE YEAR(meeting.date) = 2017");
                $reponseCoureur->execute(array());
                    while ($donnees = $reponseCoureur->fetch())
                    {
                      echo "\t",'<option value="', $donnees['id'] ,'"' ,'>', $donnees['firstname'], ' ', $donnees['lastname'] ,'</option>',"\n";
                    }
                echo '</select>';
          ?>
        <script>
            function choixCoureur() {
                var $coureur = document.getElementById('selectionCoureur').value;
                document.getElementById('numCoureur').innerHTML = "coureur num" + $coureur;
            }
        </script>
        <p id = "numCoureur"></p>
<!--/****************************************************************************-->
<!--
    Partie temporaire en considérant qu'on a selectionné un coureur avec la liste, la on le fait manuellement
-->
<?php
$idcoureur = 84; // mano
$req = $bdd->prepare("SELECT birthdate FROM athlete WHERE id=".$idcoureur);// WHERE YEAR(meeting.date) = 2017");
$req->execute(array());
$annee = $req->fetch();
$age = date("Y")-$annee['birthdate'];

echo "Le coureur num".$idcoureur." a ".$age." ans";
?>

<script>
    function calc() {
        var n1 = parseFloat(document.getElementById('n1').value);
        var $age = 28;
        //$age = date("Y")-$donneesResult['birthdate'];
        switch ($age) {
            case 10 : case 11 :
                var coef = 1.5;
                break;
            case 12 : case 13 :
                var coef = 1.42;
                break;
            case 14 : case 15 :
                var coef = 1.35;
                break;
            case 16 : case 17 :
                var coef = 1.21;
                break;
            case 18 : case 19 :
                var coef = 1.18;
                break;
            case 20 : case 21 : case 22 :
                var coef = 1.09;
                break;
            case 23: case 24 : case 25 : case 26: case 27 : case 28 : case 29: case 30 :
            case 31 : case 32 : case 33 : case 34 : case 35: case 36 : case 37 :
            case 38 : case 39 : case 40 :
                var coef = 1;
                break;
            default :
                var coef = 1.35;
        }
        var calcul = Math.round((1000/n1)*coef);
        document.getElementById('result').value = calcul;
    }
</script>



<!--
    Fin de la partie temporaire
-->
        <form method="POST" action="#"><!--"?page=envoiResult.php">-->
            <input type="text" id="n1" name = "chrono" placeholder="Chrono"/><br/> <!--au format minutes.secondes-->
            <input type="Button" name="bouton" value="Calcul des points"onclick=calc()>
            <input type="text" id="result" name = "points" placeholder="nbPoints"/>
            <input type="submit" name="validPoint" value="Envoi dans la BDD">
        </form>


    </div>


<?php
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
?>
