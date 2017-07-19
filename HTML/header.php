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
        if (isset($_SESSION['nomUser'])) {
        echo "<a href='?page=destroy'>Deconnection</a></p>";
          echo "<em>Bonjour ".$_SESSION['nomUser']."</em>";
        }
        else {
          echo"<div><a href='?page=inscription'>Connection</a></div>";
        }
    ?>
</nav>
