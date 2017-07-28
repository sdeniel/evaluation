<div class="contenu">
    <div class="presAsso">
      <!-- Section de présentation de l'association -->
      <section>
          <h2>Découverte de notre association</h2>
          <p>L’association « athletik – les 1000 pas » est une association
            de loi 1901 créée en octobre 1997 par trois marathoniens d'expériences
            qui ont une approche de la pratique basée sur le <b>loisir</b>.
            Cette association à but non lucrative a pour unique ambition de faire
            découvrir au plus grand nombre, <b>hommes et femmes, de tout âge:</b>
          </p>
          <ul>
              <li>le plaisir que procure ce sport quelques soient les capacités physiques
              dont ils disposent,
              </li>
              <li>de faire prendre conscience aux participants de leurs ressources
                intrinsèques
              </li>
              <li>de les accompagner dans leurs progressions respectives afin de
                les aider à atteindre les objectifs qu'ils se sont fixés
              </li>
          </ul>
          <p>Depuis 1997, ce sont quelques 300 hommes et femmes, de 7 à 77 ans
            qui sont venus tenter l'aventure de la course à pieds au sein d'<b>Athletik</b>
            autour des valeurs d'amitié, de respect et de solidarité sans pour autant
            se prendre au sérieux.
          </p>
          <br>
          <h2>L'Athletik challenge : les 1000 pas</h2>
          <p>Chaque année nous organisons un challenge qui rassemble tous nos adhérents
            mais également des coureurs externes afin de s'affronter sur 5 courses à pieds.
            Chaque course fait 1000 mètres, le but étant de finir le plus rapidement
            chaque course pour obtenir le meilleur résultat possible.
            Etant donné que c'est un challenge qui souhaite rassembler le maximum
            de personnes et que tout le monde n'a pas la même capacité physique, en plus
            de faire le total des 5 courses, nous ajoutons un coefficient multiplicateur
            qui favorisera les plus jeunes et les plus âgés.
          </p>
          <p>Si ça vous intéresse, pensez à vous inscrire ! Et parlez en à vos proches !</p>
      </section>
    </div>

    <!-- Le carousel -->
    <div class="divAside">
        <div class="carousel">
            <ul class="bxslider">
                <li><img src="../IMG/photo1.jpg" /></li>
                <li><img src="../IMG/photo2.jpg" /></li>
                <li><img src="../IMG/photo3.jpg" /></li>
                <li><img src="../IMG/photo4.jpg" /></li>
                <li><img src="../IMG/photo5.jpg" /></li>
            </ul>
        </div>
        <div class="news">

          <!-- Intégration de la page news.php qui donne des renseignements sur les courses passées et à venir-->
          <?php include "news.php"; ?>


        </div>
    </div>
</div>

<!-- Si besoin, la page qui m'a servi pour comprendre le fonctionnement du carousel : http://bxslider.com/ -->
<!-- On ajoute qqs options pour l'aspect graphique de notre carousel-->
<script type="text/javascript">
  $('.bxslider').bxSlider({
    auto: true,
    hideControls:true,
    pager:false
  });
</script>
