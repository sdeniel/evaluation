<?php
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
?>
