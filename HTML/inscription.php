<?php include "header.php"; ?>

<section id="inscription">

  <!-- FORMULAIRE CONNECTION
  <form class="formConnection" action="connection.php" method="POST"> 
      <h2>Se connecter</h2>
      <div class="imgcontainer">
          <img src="../IMG/login.png" alt="Avatar" class="avatar">
      </div>
      <div class="container">
          <p><input type="text" name="pseudoCo" placeholder="Login ..." required></p>
          <p><input type="password" name="passwordCo" placeholder="Password" required></p>
          <p><input type="submit" value="Me connecter"></p>
      </div>
  </form>-->


  <!-- FORMULAIRE INSCRIPTION -->
  <form class="formConnection" action="register.php?nb_alea=<?php echo $_SESSION['aleat_nbr'];?>" method="POST">
      <h2>S'enregistrer</h2>
      <div class="imgcontainer">
          <img src="../IMG/register.png" alt="Avatar" class="avatar">
      </div>
      <div class="container">
          <p><input type="text" name="loginIns" placeholder="Login ..." required/></p>
          <p><input type="password" name="passwordIns" placeholder="Password ..." required/></p>
          <p><input type="password" name="passwordCo2" placeholder="Password ..." required></p>
          <p><input type="text" name="emailIns" placeholder="Email ..." required/></p>
          <p><img src="captcha.php" alt="Code de vérification" /></p>
          <p><input type="text" name="verif_code" placeholder="Renseigner le captcha ..."required/></p>
          <p><input type="submit" value="Créer mon compte"/></p>
      </div>
  </form>



</section>
