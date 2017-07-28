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
        $ajoutcourse = new ResultatsAdmin;
        $ajoutcourse->ajoutCoursef();
        ?>

    </div>
    <div class ="modeAdminTab">
        <h3>Entrer les temps des participants</h3>

        <?php
        //$choixcourse = new Essai;
        //$choixcourse->choixCoursef();
        echo "Choix de la course<br/>";
        $req = $bdd -> prepare ('SELECT name FROM meeting');
        $req->execute();
        $i = 0;
        while ($donneesNomCourse = $req->fetch())
        {
              $i++;
              echo '<a href="?page=update&&course='.$i.'">'.$donneesNomCourse['name'].'</a><br/>';
        }
        ?>
