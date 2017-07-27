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
        $numCourse = "";

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

        <?php echo "Choix de la course<br/>";
        $req = $bdd -> prepare ('SELECT name FROM meeting');
        $req->execute();
        $i = 0;
        while ($donneesNomCourse = $req->fetch())
        {
              $i++;
              echo '<a href="?page=update&&course='.$i.'">'.$donneesNomCourse['name'].'</a><br/>';

        }
        ?>
