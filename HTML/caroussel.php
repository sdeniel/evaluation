<script type="text/javascript">
ul{
     width:1800px;
     -webkit-animation: animNom 20s ease 0s infinite;
        -moz-animation: animNom 20s ease 0s infinite;
         -ms-animation: animNom 20s ease 0s infinite;
          -o-animation: animNom 20s ease 0s infinite;
             animation: animNom 20s ease 0s infinite;
}

@keyframes animNom {
from, 14%, to {transform:translateX(0px);}
16%, 30% {transform:translateX(-300px);}
32%, 46% {transform:translateX(-600px);}
48%, 62% {transform:translateX(-900px);}
64%, 78% {transform:translateX(-1200px);}
80%, 96% {transform:translateX(-1500px);}
}
</script>


<!--<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
  </style>
</head>
<body>

<div class="container">
  <div id="myCarousel" class="carousel slide">

    <ol class="carousel-indicators">
      <li class="item1 active"></li>
      <li class="item2"></li>
      <li class="item3"></li>
    </ol>


    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="../IMG/photo1.jpg" alt="Chantal" width="230" height="170">
        <div class="carousel-caption">
          <h3>Chantal est contente</h3>
          <p>Fais gaffe Chantal, tu vas te faire doubler par Maurice.</p>
        </div>
      </div>

      <div class="item">
        <img src="../IMG/photo2.jpg" alt="JeanCLaude" width="230" height="170">
        <div class="carousel-caption">
          <h3>Jean Claude est chaud patate pour gagner l'Athletic Challenge</h3>
          <p>Notre double champion qui va remettre son titre en jeu. </p>
        </div>
      </div>

      <div class="item">
        <img src="../IMG/photo3.jpg" alt="Flower" width="230" height="170">
        <div class="carousel-caption">
          <h3>Départ arrêté</h3>
          <p>Ils sont motivés les jeunes.</p>
        </div>
      </div>

    </div>


    <a class="left carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel();

    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });

    // Enable Carousel Controls
    $(".left").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function(){
        $("#myCarousel").carousel("next");
    });
});
</script>

</body>
</html>-->
