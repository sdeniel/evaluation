<?php
try {
    include "controlleur.php";

    $reponse = $bdd->prepare("SELECT * FROM meeting WHERE YEAR(meeting.date) = 2017 ORDER BY date ASC");
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


 ?>
