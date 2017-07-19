<?php
//Sécurisation des données saisies pour l'inscription'
$nom = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'birthyear', FILTER_SANITIZE_NUMBER_INT);

if ($date < 1900 || $date > )

try {
    $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation d'insertion, création des marqueurs
    $req = $bdd -> prepare (
        'INSERT INTO '.$_SESSION['tableAthlete'].'(firstname, lastname, birthdate)
        VALUES(:firstname, :lastname, :birthdate)');
    // lier nos marqueurs à nos variables (protection)

    $req->bindParam(':firstname', $prenom);
    $req->bindParam(':lastname', $nom);
    $req->bindParam(':birthdate', $date);
    // Execution des instructions
    $req->execute();

}
catch (Exception $e) {
      echo 'Exception reçue : ',  $e->getMessage(), "\n";
  }
?>
