<header>
  <h1>Athletik</h1>
</header>

<nav>
    <div class=""><a href="?page=accueil">Présentation</a>
    </div>
    <div class=""><a href="?page=participation">Participation</a>
    </div>
    <div class=""><a href="?page=resultats">Résultats</a>
    </div>
    <?php
    // On appelle la page class.php et on créé un nouvel objet de la Class Connection
    include "class.php";
    $checkheader = new Header;

    // Appel de la méthode
    $checkheader->headerf(); 
    ?>
</nav>
