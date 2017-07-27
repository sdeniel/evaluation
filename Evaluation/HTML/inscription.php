<section id="inscription">

      <!-- FORMULAIRE CONNECTION-->
      <form class="formConnection" action="?page=connection" method="POST">
            <h2>Me connecter</h2>
            <div class="imgcontainer">
                <img src="../IMG/login.png" alt="Avatar" class="avatar">
            </div>
            <div class="container">
                <p><input type="text" name="pseudoCo" placeholder="Login ..." required></p>
                <p><input type="password" name="passwordCo" placeholder="Password" required></p>
                <p><input type="submit" value="Me connecter"></p>
            </div>
     </form>

    <!-- FORMULAIRE INSCRIPTION-->
    <form class="formConnection" action="?page=register" method="POST">
        <h2>Créer mon compte</h2>
        <div class="imgcontainer">
            <img src="../IMG/register.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <p><input type="text" name="loginIns" placeholder="Login ..." required/></p>
            <p><input type="password" name="passwordIns" placeholder="Password ..." required/></p>
            <p><input type="password" name="passwordIns2" placeholder="Password ..." required></p>
            <p><input type="text" name="emailIns" placeholder="Email ..." required/></p>
            <div class="g-recaptcha" data-sitekey="6LfXnikUAAAAALy564W7UNbGmz9dQahpBSNUyiMx"></div>
            <p><input type="submit" value="Créer mon compte"/></p>
        </div>
    </form>
</section>
