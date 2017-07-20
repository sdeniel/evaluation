<h3>Ajouter une course</h3>

<form method="POST" action="#">
    <label>Lieu</label><input type="text" name="addLieu" required/>
    <label>Description</label><input type="text" name="addDescription" required/>
    <label>Date</label><input type="date" name="addDate" required/>
    <input type="submit" name="ok" value="ok" />
</form>
<?php



if(isset($_POST))
    {
    $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // AJOUT D'UNE NOUVEAU COURSE
    $req = $bdd -> prepare ('INSERT INTO '.$_SESSION["tableCourse"].'(id, name, description, date)
                             VALUES(:id, :name, :description, : date)');

    $addLieu = filter_input(INPUT_POST, 'addLieu', FILTER_SANITIZE_STRING);
    $addDescription = filter_input(INPUT_POST, 'addDescription', FILTER_SANITIZE_STRING);
    $addDate = filter_input(INPUT_POST, 'addDate', FILTER_SANITIZE_NUMBER_INT);

    $req->bindParam(':titre', $addLieu);
    $req->bindParam(':realisateur', $addDescription);
    $req->bindParam(':acteurs', $addDate);

  }
?>

<h3>Entrer les temps des participants</h3>
