<?php
$secretKey = '6LfXnikUAAAAANZC-9ESxSR66y-edVN3p7mVLKJU'; // votre clé privée
//Sécurisation des données saisies pour l'inscription'
$loginIns = filter_input(INPUT_POST, 'loginIns', FILTER_SANITIZE_STRING);
$passwordIns = filter_input(INPUT_POST, 'passwordIns', FILTER_SANITIZE_STRING);
$passwordIns2 = filter_input(INPUT_POST, 'passwordIns2', FILTER_SANITIZE_STRING);
$emailIns = filter_input(INPUT_POST, 'emailIns', FILTER_VALIDATE_EMAIL);

$captcha;
if(isset($_POST['g-recaptcha-response'])) {
    $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    exit();
}
$ip = $_SERVER['REMOTE_ADDR'];
$aContext = array(
    'http' => array(
        'proxy' => 'tcp://10.127.254.1:80',
        'request_fulluri' => true,
    ),
);
$cxContext = stream_context_create($aContext);
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip, false, $cxContext);
$responseKeys = json_decode($response, true);
if(intval($responseKeys["success"]) !== 1) {
      $_SESSION['res'] = 6;
    header('Location: ?page=resultatConnecte');
}
else {

          if (!$emailIns) {
              $_SESSION['res'] = 0;
              header('Location: ?page=resultatConnecte');
          }
          elseif ($passwordIns != $passwordIns2) {
              $_SESSION['res'] = 4;
              header('Location: ?page=resultatConnecte');
          }
          else {
              try {
                  $bdd = new PDO('mysql:host='.$_SESSION['serveur'].'; dbname='.$_SESSION['baseDonnees'].'; charset=utf8', $_SESSION['pseudo'], $_SESSION['pass']);
                  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  // verif login existant
                  $veriflog = $bdd->query("SELECT login FROM user WHERE login='$loginIns'");
                  if ($donnees = $veriflog->fetch()) {
                      $_SESSION['res'] = 5;
                      header('Location: ?page=resultatConnecte');
                  }
                  else {
                    // verif email existant
                    $verifmail = $bdd->query("SELECT email FROM user WHERE email='$emailIns'");
                    if ($donnees = $verifmail->fetch()) {
                        $_SESSION['res'] = 0;
                        header('Location: ?page=resultatConnecte');
                    }
                    else {

                      // Préparation d'insertion, création des marqueurs
                      $req = $bdd -> prepare (
                          'INSERT INTO '.$_SESSION['tableLogin'].'(login, password, email)
                          VALUES(:identifiant, :password, :email)');
                      // lier nos marqueurs à nos variables (protection)

                      $req->bindParam(':identifiant', $loginIns);
                      $req->bindParam(':password', $passwordIns);
                      $req->bindParam(':email', $emailIns);
                      // Execution des instructions
                      $req->execute();
                      $_SESSION['res'] = 1;
                      header('Location: ?page=resultatConnecte');
                    }
                  }
                }
                catch (Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                }
          }
      }
?>
