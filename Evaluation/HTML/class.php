<?php
//////////////////////////////////////////////////////////////////////////////////////////////
class Connection {
  function connectionf()   {
    //Informations d'entrées du serveur + base de données (+ table associée ?)
    $_SESSION['nomUser']= filter_input(INPUT_POST, 'pseudoCo', FILTER_SANITIZE_STRING);

    //Sécurisation des données saisies pour la connection
    $log = htmlspecialchars($_POST['pseudoCo']);
    $password = htmlspecialchars($_POST['passwordCo']);

    //On récupère nos données de la BDD, de la table des login
    try {
        include "controlleur.php";

        $reponse = $bdd->query('SELECT * FROM user WHERE login = "'.$log.'"');
        $donnees = $reponse->fetch(PDO::FETCH_ASSOC);

        // On vérifie les ID et mot de passe de l'utilisateur, si ok on passe à la page d'accueil
        if (isset($donnees['login'])&&($donnees['login'] == $log)) {
          // check du mot de passe tapé à celui hashé
          if (password_verify($password, $donnees['password'])) {
            $_SESSION['nomUser'] = $log;
            header('Location: ?page=accueil');
            $_SESSION['res'] = 1;
            exit();
          }
        }
        // sinon on reste sur la page de login
        else {
            $_SESSION['res'] = 3;
            header('Location: ?page=resultatConnecte');
        }
    }
    catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////
class TestAge {
  function testAgef()   {
    try {
        include "controlleur.php";

        $reponseResult = $bdd->prepare("SELECT athlete.*, result.time, result.points  FROM athlete inner join result on athlete.id = result.id WHERE result.meeting_id =1 ORDER BY firstname ASC");
        $reponseResult->execute(array());
        echo "<h3>Resultats de la course</h3>";
        $i=0;
        while ($donneesR = $reponseResult->fetch())
        {
            $age = date("Y")-$donneesR['birthdate'];
            switch ($age) {
              case 10 : case 11 :
                  echo "Poussin";
                  break;
              case 12 : case 13 :
                  echo "Benjamin";
                  break;
              case 14 : case 15 :
                  echo "Minime";
                  break;
              case 16 : case 17 :
                  echo "Cadet";
                  break;
              case 18 : case 19 :
                  echo "Junior";
                  break;
              case 20 : case 22 :
                  echo "Espoir";
                  break;
              case 23 : case 40 :
                  echo "Sénior";
                  break;
              default :
                  echo "Master";
            }
        }
    }
    catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class CalculDate
{
  function calculDatef()
  {
    try {
        include "controlleur.php";

        $reponseDate = $bdd->prepare("SELECT * FROM meeting WHERE YEAR(meeting.date) = 2017 ORDER BY date ASC");
        $reponseDate->execute();

    // CALCUL DATE DE L'EVENT PAR RAPPORT A LA DATE DU JOUR POUR DEFINIR SI C'EST PASSE OU FUTUR
        $passe = 0;
        $futur = 0;
        $now = 0;
        while ($dates = $reponseDate->fetch())
        {
            $jour_auj = date("j");
            $mois_auj = date("n");
            $annee_auj = date("Y");
            $date1 = $jour_auj.'-'.$mois_auj.'-'.$annee_auj;
            $date2 = $dates['date'];
            // On détermine les évenements passés
            if(strtotime($date1) > strtotime($date2))
            {
                $passeEvent[$passe] = $dates['name'];
                $passeDate[$passe] = implode('/', array_reverse(explode('-', $dates['date'])));
                $passe +=1;
            }
            // On détermine les évenements futurs
            else if(strtotime($date1) < strtotime($date2))
            {
                $futurEvent[$futur] = $dates['name'];
                $futurDate[$futur] = implode('/', array_reverse(explode('-', $dates['date'])));
                $futur +=1;
            }
            // On détermine les évenements du jour
            else
            {
              $nowEvent[$now] = $dates['name'];
              $now +=1;
            }
        }

    // Mise en forme dans le bloc News de la page d'accueil
      echo "<h3>Evenements passés</h3>";
      if($passe == 0) echo "Pas de course recencée.";
      else {
        for($i=0; $i < $passe; $i++) {
        echo "A ".$passeEvent[$i]." le ".$passeDate[$i]."<br/>";
        }
      }
      echo "<h3>Evenements aujourd'hui</h3>";
      if($now == 0) echo "Pas de course recencée.";
      else {
        for($i=0; $i < $now; $i++) {
          echo "A ".$nowEvent[$i]."<br/>";
        }
      }
      echo "<h3>Evenements futurs</h3>";
      if($futur == 0) echo "Pas de course recencée.";
      else {
        for($i=0; $i < $futur; $i++) {
        echo "A ".$futurEvent[$i]." le ".$futurDate[$i]."<br/>";
        }
      }

      }
      catch (Exception $e) {
          echo 'Exception reçue : ',  $e->getMessage(), "\n";
      }
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class Challenge
{
  function challengef()
  {
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
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class Participation
{
  function participationf()
  {
    if (!isset($_SESSION['nomUser']))
    {
    echo '<br/>Veuillez vous connecter <a href="?page=inscription">en cliquant ici</a> pour accéder à l\'inscription du prochain Event.';
    }
    else {

        try {
            include "controlleur.php";

// Calcul du nombre de ticket
            $req1 = $bdd -> prepare ('SELECT ticket FROM user WHERE login = :username');
            $req1->bindValue(':username', $_SESSION['nomUser']);
            $req1->execute();
            $donnees1 = $req1->fetch();

            $_SESSION['value'] = $donnees1['ticket'];

// On regarde si la personne connectée est admin ou non
            $req2 = $bdd -> prepare ('SELECT admin FROM user WHERE login = :username');
            $req2->bindValue(':username', $_SESSION['nomUser']);
            $req2->execute();
            $donnees2 = $req2->fetch();


// Si la personne connectée est admin ou n'a pas encore fait de ticket de participation, elle accède au formulaire
            if (($_SESSION['value'] != 1)||($donnees2['admin'] == 1)) {
                ?>
                <!-- Pas le temps de gérer automatiquement le nom des prochaines course, donc à la mano -->
                <h3>Inscription pour la prochaine course : <?php echo $_SESSION['nomCourse'];?></h3>
                <form class="formfiche" action="?page=challenge" method="POST">
                      <h2>Fiche de renseignement</h2>
                      <div class="imgcontainer">
                          <img src="../IMG/fiche.png" alt="Avatar" class="avatar">
                      </div>
                      <div class="fiche">
                          <p><input type="text" name="lastname" placeholder="Nom" required></p>
                          <p><input type="text" name="firstname" placeholder="Prenom" required></p>
                          <p><input type="year" name="birthyear" placeholder="Année de naissance" required></p>
                          <p><input type="submit" name="validation" value="Créer ma fiche"></p>
                      </div>
                </form><?php

            }
// Message d'erreur si elle est déjà inscrite
            else {
              echo "<br/>Vous êtes déjà inscrit pour la course ;)";
            }
        }
        catch (Exception $e) {
              echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }


    }
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class Register
{
  function registerf()
  {
    $secretKey = '6LfXnikUAAAAANZC-9ESxSR66y-edVN3p7mVLKJU'; // votre clé privée
    //Sécurisation des données saisies pour l'inscription'
    $loginIns = filter_input(INPUT_POST, 'loginIns', FILTER_SANITIZE_STRING);
    $passwordIns = filter_input(INPUT_POST, 'passwordIns', FILTER_SANITIZE_STRING);
    $passwordIns2 = filter_input(INPUT_POST, 'passwordIns2', FILTER_SANITIZE_STRING);
    $password = password_hash($passwordIns, PASSWORD_DEFAULT);
    $emailIns = filter_input(INPUT_POST, 'emailIns', FILTER_VALIDATE_EMAIL);

    $captcha;
    if(isset($_POST['g-recaptcha-response'])) {
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        echo '<h2>Problème de Captcha</h2>';
        exit();
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $aContext = array(
        'http' => array(
            'proxy' => 'tcp://10.127.254.1:80',
            'request_fulluri' => true,
        ),
    );
    $cxContext = stream_context_create($aContext);
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip, false, $cxContext);
    $responseKeys = json_decode($response, true);
    if(intval($responseKeys["success"]) !== 1) {
          $_SESSION['res'] = 6;
        header('Location: ?page=resultatConnecte');
    }
    else {

              if (!$emailIns) {
                  $_SESSION['res'] = 0;
                  header('Location: ?page=resultatConnecte');
              }
              elseif ($passwordIns != $passwordIns2) {
                  $_SESSION['res'] = 4;
                  header('Location: ?page=resultatConnecte');
              }
              else {
                  try {
                      include "controlleur.php";

                      // verif login existant
                      $veriflog = $bdd->query("SELECT login FROM user WHERE login='$loginIns'");
                      if ($donnees = $veriflog->fetch()) {
                          $_SESSION['res'] = 5;
                          header('Location: ?page=resultatConnecte');
                      }
                      else {
                        // verif email existant
                        $verifmail = $bdd->query("SELECT email FROM user WHERE email='$emailIns'");
                        if ($donnees = $verifmail->fetch()) {
                            $_SESSION['res'] = 0;
                            header('Location: ?page=resultatConnecte');
                        }
                        else {

                          // Préparation d'insertion, création des marqueurs
                          $req = $bdd -> prepare ('INSERT INTO '.$_SESSION['tableLogin'].'(login, password, email)
                                                  VALUES(:identifiant, :password, :email)');

                          $req->bindParam(':identifiant', $loginIns);
                          $req->bindParam(':password', $password);
                          $req->bindParam(':email', $emailIns);
                          // Execution des instructions
                          $req->execute();
                          $_SESSION['res'] = 1;
                          header('Location: ?page=resultatConnecte');
                        }
                      }
                    }
                    catch (Exception $e) {
                        echo 'Exception reçue : ',  $e->getMessage(), "\n";
                    }
              }
          }
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class ResultCo
{
  function resultcof()
  {
    $resultat = $_SESSION['res'];

    // les différents cas de figure lorsque l'on remplit les champ de connection et de création de compte
    switch($resultat) {
      case 0 :
        echo "L'adresse email a été mal renseigné ou est déjà utilisée, veuillez recommencer ..."."<br/>";
        break;
      case 1 :
        echo "Vous vous êtes bien enregistré. A présent, vous pouvez vous connecter pour profiter de notre merveilleux site"."<br/>";
        break;
      case 2 :
        echo "Le captcha a été mal renseigné, veuillez recommencer ..."."<br/>";
        break;
      case 3 :
        echo "La combinaison pseudo & password renseignée n'est pas dans notre base de données."."<br/>".
        "Veuillez recommencer ..."."<br/>";
        break;
      case 4 :
        echo "Les mots de passe renseignés ne sont pas identiques."."<br/>".
        "Veuillez recommencer ..."."<br/>";
        break;
      case 5 :
        echo "Pseudo déjà utilisé."."<br/>".
        "Veuillez recommencer ..."."<br/>";
        break;
      case 6 :
          echo "T'es un noob tu sais pas cliquer sur le captcha."."<br/>".
          "Veuillez recommencer NOOB..."."<br/>";
          break;
    }

    echo '<a href="?page=inscription">'."Retour à la page d'identification".'</a>';
    // redirection sur l'espace de login avec un clic
    }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class Resultats
{
  function resultatsf()
  {
    // GESTIONNAIRE ADMIN OU AUTRE POUR L'ACCES GESTION OU LECTURE DES DONNEES
    try {
        include "controlleur.php";

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
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class Header {
  function headerf() {
      // Si on est connecté en tant qu'utilisateur, message de bienvenue + possibilité de se deconnecter
      if ((isset($_SESSION['nomUser']))&&($_SESSION['res'] == 1)) {
      echo "<a href='?page=destroy'>Deconnection</a></p>";
        echo "<em>Bonjour ".$_SESSION['nomUser']."</em>";
      }
      // Sinon possibilité de se connecter
      else {
        echo"<div><a href='?page=inscription'>Connection</a></div>";
      }
  }
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
class ResultatsAdmin
{
  function ajoutCoursef()
  {
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
  }
  /*function choixCoursef()
  {
      // A ajouter ... ne fonctionnait pas ici. Why ?
      /*echo "Choix de la course<br/>";
      $req = $bdd -> prepare ('SELECT name FROM meeting');
      $req->execute();
      $i = 0;
      while ($donneesNomCourse = $req->fetch())
      {
            $i++;
            echo '<a href="?page=update&&course='.$i.'">'.$donneesNomCourse['name'].'</a><br/>';
      }
  }*/
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////
class ResultatsUsers
{
  function consultationResultatsf()
  {
    /*// RESULTATS + CLASSEMENT
      echo "<div class='resultatClassement'><div class='ole'>";

      // Résultats
        $reponseResult = $bdd->prepare("SELECT athlete.*, result.time, result.points  FROM athlete inner join result on athlete.id = result.id WHERE result.meeting_id =1 ORDER BY firstname ASC");
        $reponseResult->execute(array());
        echo "<h3>Resultats de la dernière course</h3>";
        while ($donneesResult = $reponseResult->fetch())
        {
          echo "<div class='test'><div><div>".$donneesResult['firstname']." ";
          echo $donneesResult['lastname']."</div></div><div><div>";
              $age = date("Y")-$donneesResult['birthdate'];
              switch ($age) {
                case 10 : case 11 :
                    echo "Poussin";
                    break;
                case 12 : case 13 :
                    echo "Benjamin";
                    break;
                case 14 : case 15 :
                    echo "Minime";
                    break;
                case 16 : case 17 :
                    echo "Cadet";
                    break;
                case 18 : case 19 :
                    echo "Junior";
                    break;
                case 20 : case 22 :
                    echo "Espoir";
                    break;
                case 23 : case 40 :
                    echo "Sénior";
                    break;
                default :
                    echo "Master";
              }
          echo "</div></div><div><div>".$donneesResult['points']." points</div></div></div>";
        }
        echo "</div><div class='podium'><h3>Classement Général</h3>";
    //******************************************************************************************************************

    //******************************************************************************************************************
      // classement
        $reponseClass = $bdd->prepare("SELECT SUM(result.points) as total, athlete.lastname, athlete.firstname FROM result inner join athlete on result.athlete_id = athlete.id inner join meeting on result.meeting_id = meeting.id WHERE YEAR(CURRENT_DATE()) = 2017 GROUP BY athlete.id ORDER BY total DESC ");
        $reponseClass->execute(array());
        $i = 1;
        while ($donneesClass = $reponseClass->fetch())
        {
          echo "<div class='test2'><div>".$i." : ".$donneesClass['firstname']." ";
          echo $donneesClass['lastname']."</div></div>";
          $i++;
        }
        echo "</div>";
    */
  }
}

////////////////////////////////////////////////////////////////////////////////

?>
