<?php
    if (!isset($_SESSION['nomUser'])) {
    echo '<br/>Veuillez vous connecter <a href="?page=inscription">en cliquant ici</a> pour accéder à l\'inscription du prochain Event.';
    }
    else {?>
      <h3>Participation à l'Athletic Challenge</h3>
      <form class="formfiche" action="?page=challenge" method="POST">
            <h2>Fiche de renseignement</h2>
            <div class="imgcontainer">
                <img src="../IMG/fiche.png" alt="Avatar" class="avatar">
            </div>
            <div class="fiche">
                <p><input type="text" name="lastname" placeholder="Nom" required></p>
                <p><input type="text" name="firstname" placeholder="Prenom" required></p>
                <p><input type="year" name="birthyear" placeholder="Année de naissance" required></p>
                <p><input type="submit" value="Créer ma fiche"></p>
            </div>
      </form><?php
    }
?>
<!--<p>Si pas enregistré, s'enregistrer, else préremplir le formulaire !</p>-->
