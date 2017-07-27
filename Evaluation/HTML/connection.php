<?php

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

?>
