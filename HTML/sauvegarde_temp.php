<div class = "modeAdmin">
    <div class = "modeAdminform">
        <h3>Ajouter une course</h3>

        <form method="POST" action="#">
            <input type="text" name="addLieu" placeholder="Lieu" required/>
            <input type="text" name="addDescription" placeholder="Description"/>
            <input type="date" name="addDate" placeholder="Date : aaaa-mm-jj"/>
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

            if (!empty($addLieu)) {
                $req->execute();
            }

          }
        ?>
    </div>
    <div class ="modeAdminTab">
        <h3>Entrer les temps des participants</h3>

        <?php
/*******************************************************************************/
        // Liste des Courses de 2017
        $reponseCourse = $bdd->prepare("SELECT * FROM meeting WHERE YEAR(meeting.date) = 2017");
        $reponseCourse->execute(array());

        // Variable qui ajoutera l'attribut selected de la liste déroulante
        $selected = '';
        // Parcours du tableau
        echo '<form method="post" action="#"><select id="selectionCourse" onchange="choix();">',"\n","<option selected disabled>Choix de la course</option>";
        $i = 1;
        while ($donnees = $reponseCourse->fetch())
        {
          $meeting[$i] = $donnees['name'];
          echo "\t",'<option value="', $i ,'"', $selected ,'>', $meeting[$i] ,'</option>',"\n";
          $selected='';
          $i++;
        }
        echo '</select>',"\n</form>";

        ?>
        <script>
            function choix() {
                var $course = document.getElementById('selectionCourse').value;
                document.getElementById('essai').innerHTML = "course num : " + $course;
            }
        </script>
        <p id="essai"></p>
        <?php
/*******************************************************************************/
        // Liste des participants de la course selectionnée
        $reponseRunner = $bdd->prepare("SELECT * FROM athlete");
        $reponseRunner->execute(array());

        // Variable qui ajoutera l'attribut selected de la liste déroulante
        $selected = '';
        // Parcours du tableau
        echo '<form method="post" action="#"><select id="selectionRunner" onchange="choixRunner();">',"\n","<option selected disabled>Choix de l'athlete</option>";
        $j = 1;
        while ($donnees = $reponseRunner->fetch())
        {
          $firstname[$j] = $donnees['firstname'];
          $lastname[$j] =$donnees['lastname'];
          echo "\t",'<option value="', $j ,'"', $selected ,'>', $firstname[$j]," ", $lastname[$j],'</option>',"\n";
          $selected='';
          $j++;
        }
        echo '</select>',"\n</form>";
        ?>
        <script>
            function choixRunner() {
                var $coureur = document.getElementById('selectionRunner').value;
                document.getElementById('essai2').innerHTML = "Athlete num : " + $coureur;
            }
        </script>
        <p id="essai2"></p>

        <script>
            function calc() {
                var n1 = parseFloat(document.getElementById('n1').value);
                var coef = 1;
                var calcul = Math.round((1000/n1)*coef);
                document.getElementById('result').value = calcul;
            }
        </script>


        <form method="POST" action="#">
            <input type="text" id="n1" placeholder="Chrono"/><br/> <!--au format minutes.secondes-->
            <input type="Button" name="bouton" value="Calcul des points"onclick=calc()>
            <input type="text" id="result" placeholder="nbPoints"/>
        </form>


    </div>
