<?php
try {
    $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation d'insertion, création des marqueurs
    $donneesTest['admin'] = 0;  // initialisation dans le cas visiteur non connecté
    if (isset($_SESSION['nomUser'])){ // isset pour différencier les users connectés
        $req = $bdd -> prepare ('SELECT * FROM user WHERE login = :username');
        $req->bindValue(':username', $_SESSION['nomUser']);
        $req->execute();
        $donneesTest = $req->fetch();
    }

      // Si l'admin va sur la page resultat il ira sur une page spécifique
      if ($donneesTest['admin'] == 1) {
          include "resultatsAdmin.php";
      }
      // les utilisateurs lambda iront sur une page standard
      else  {
          include "resultatsUsers.php";
      }
    }
    catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
?>
