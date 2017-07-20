<?php
//Sécurisation des données saisies pour l'inscription'
$nom = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'birthyear', FILTER_SANITIZE_NUMBER_INT);

// verification conformité année de naissance
$agemin = date("Y")-10;
if ($date < 1900 || $date > $agemin) {
  $age = date("Y")-$date;
  echo 'Vous avez noté que vous êtiez né en '.$date.', dans ce cas vous devriez avoir '.$age.' ans<br/>';//.(date("Y")-$date;//."sous entend que vous avez".(date("Y")-$date";
      if ($age > 110)
          {
            echo "A cet âge vous ne devriez pas courir mais plutôt mourir. Pensez à la sécu !<br/>";
            echo "si vous vous êtes trompé d'année : <a href='?page=participation'>Réessayer</a></p>";
          }
      else if ($age < 0)
          {
            echo " Je vois bien que vous êtes motivé mais vous n'êtes pas encore né !<br/>";
            echo "si vous vous êtes trompé d'année : <a href='?page=participation'>Réessayer</a></p>";
          }
      else if ($age < 10)
        {
            echo "Tu es trop jeune pour participer à la course (10 ans minimum).<br/>";
            echo "si vous vous êtes trompé d'année : <a href='?page=participation'>Réessayer</a></p>";
        }
}
else {
    try {
        $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation d'insertion, création des marqueurs
        $req = $bdd -> prepare (
            'INSERT INTO '.$_SESSION['tableAthlete'].'(firstname, lastname, birthdate)
            VALUES(:firstname, :lastname, :birthdate)');



        $req->bindParam(':firstname', $prenom);
        $req->bindParam(':lastname', $nom);
        $req->bindParam(':birthdate', $date);
        // Execution des instructions
        $req->execute();
        echo "Votre inscription s'est bien déroulée.<br/>";
        echo "Bonne chance ".$prenom." ;)";

    }
    catch (Exception $e) {
          echo 'Exception reçue : ',  $e->getMessage(), "\n";
  }
}
?>
