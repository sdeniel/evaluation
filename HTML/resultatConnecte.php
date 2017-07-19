<?php

$resultat = $_SESSION['res'];



// les différents cas de figure
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
?>
