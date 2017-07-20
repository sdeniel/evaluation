<?php
try {
    $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $reponse = $bdd->prepare("SELECT * FROM meeting WHERE YEAR(meeting.date) = 2017");
    $reponse->execute();

// CALCUL DATE DE L'EVENT PAR RAPPORT A LA DATE DU JOUR POUR DEFINIR SI C'EST PASSE OU FUTUR
    $passe = 0;
    $futur = 0;
    $now = 0;
    while ($dates = $reponse->fetch())
    {
        $jour_auj = date("j");
        $mois_auj = date("n");
        $annee_auj = date("Y");
        $date1 = $jour_auj.'-'.$mois_auj.'-'.$annee_auj;
        $date2 = $dates['date'];
        if(strtotime($date1) > strtotime($date2))
        {
            $passeEvent[$passe] = $dates['name'];
            $passeDate[$passe] = $dates['date'];
            $passe +=1;
        }
        else if(strtotime($date1) < strtotime($date2))
        {
            $futurEvent[$futur] = $dates['name'];
            $futurDate[$futur] = $dates['date'];
            $futur +=1;
        }
        /*else
        {
            $nowEvent[$now] = $dates['name'];
            $nowDate[$now] = $dates['date'];
            $now +=1;
        }*/
    }


  echo "<h3>Evenements passés</h3>";
  for($i=0; $i < $passe; $i++) {
    echo "A ".$passeEvent[$i]." le ".$passeDate[$i]."<br/>";
  }
  //echo "<h3>Evenements aujourd'hui</h3>".$nowEvent.$nowDate;
  echo "<h3>Evenements futurs</h3>";
  for($i=0; $i < $futur; $i++) {
    echo "A ".$futurEvent[$i]." le ".$futurDate[$i]."<br/>";
  }

  }
  catch (Exception $e) {
      echo 'Exception reçue : ',  $e->getMessage(), "\n";
  }


 ?>
