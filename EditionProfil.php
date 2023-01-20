<?php
session_start();

include("Database.php");







  if(isset($_SESSION['id']))
  {
     $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ? ");
      $requser->execute(array($_SESSION['id']));
      $user = $requser->fetch();

      // Code pour modifier le Nom
      if(isset($_POST['newNom']) and !empty($_POST['newNom']) and $_POST['newNom'] != $user['nom'])
      {
          $newNom = htmlspecialchars($_POST['newNom']);
        $requeteNom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id = ? ");
          $requeteNom->execute(array($newNom, $_SESSION['id']));
          header('Location:Profil.php?id='.$_SESSION['id']);

      }
      // Code pour modifier le Prenom
      if(isset($_POST['newPrenom']) and !empty($_POST['newPrenom']) and $_POST['newPrenom'] != $user['prenom'])
      {
          $newPrenom = htmlspecialchars($_POST['newPrenom']);
        $requetePrenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id = ? ");
          $requetePrenom->execute(array($newPrenom, $_SESSION['id']));
          header('Location: Profil.php?id='.$_SESSION['id']);



      }

      // Code pour modifier le Mail
       if(isset($_POST['newMail']) and !empty($_POST['newMail']) and $_POST['newMail'] != $user['mail'])
      {
          $newMail = htmlspecialchars($_POST['newMail']);
        $requeteMail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ? ");
          $requeteMail->execute(array($newMail, $_SESSION['id']));
          header('Location: Profil.php?id='.$_SESSION['id']);



      }
      // Code pour modifier le Numero de téléphone
       if(isset($_POST['newNumTel']) and !empty($_POST['newNumTel']) and $_POST['newNumTel'] != $user['numTel'])
      {
          $newNumtel = htmlspecialchars($_POST['newNumTel']);
        $requeteNumTel = $bdd->prepare("UPDATE membres SET numTel = ? WHERE id = ? ");
          $requeteNumTel->execute(array($newNumTel, $_SESSION['id']));
          header('Location: Profil.php?id='.$_SESSION['id']);



      }

      //Code pour modifier le Mot passe
       if(isset($_POST['newMotdepass']) and !empty($_POST['newMotdepass']) and $_POST['newMotdepass'] != $user['motdepass'])
      {
          $newMotdepass = sha1($_POST['newMotdepass']);
        $requeteMotdepass = $bdd->prepare("UPDATE membres SET newMotdepass = ? WHERE id = ? ");
          $requeteMotdepass->execute(array($newMotdepass, $_SESSION['id']));
          header('Location: Profil.php?id='.$_SESSION['id']);



      }

  }



?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/exemple.css">
  <script scr="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="js/script.js"></script>
<title>Apprenetissage avec Bootstrap</title>
</head>
<body>

    <header>


    </header>
    <section>

       <div class="row">
           <div class="bg-primary container-fluid text-white">
              <h1><b><i>EDITION DE MON PROFIL</i></b></h1>
           </div >
           <form method="post" action="">
              <div class="form-group" style="margin-top:20px ; margin-left:50px">
                  <label for="nom"><i><b><big>Nom :</big></b></i></label>
                <input type="text" name="newNom" placeholder="Nom" class="form-control" value="<?php echo $user['nom'] ;?>" id="nom">
                  <label for="prenom"><i><b><big>Prenom :</big></b></i></label>
                <input type="text" name="newPrenom" placeholder="Prenom" class="form-control" value="<?php echo $user['prenom'] ;?>" id="prenom">
                    <label for="mail"><i><b><big>Mail :</big></b></i></label>
                   <input type="email" name="newMail" placeholder="Mail" class="form-control" value="<?php echo $user['mail'] ; ?>" id="mail">
                   <label for="numTel"><i><b><big>Numéro de téléphone :</big></b></i></label>
                 <input type="text" name="newNumTel" placeholder="Tel" class="form-control" value="<?php echo $user['numTel'] ;?>" id="numTel">
                    <label for="mpd"><i><b><big>Mot de passe :</big></b></i></label>
                   <input type="password" name="newMotdepass" placeholder="Mot de pass" class="form-control" value="<?php echo $user['motdepass']; ?>" id="mpd"><br>
                  <input type="submit" class="btn btn-primary" value="Mettre à jour mon profil">
                  <button type="reset" class="btn btn-danger">Effacer</button>
                  <!-- <a href="Connexion.php" class="btn btn-success">Se Reconnecter</a> -->

               </div>
           </form>

        </div>

        </div>
    </section>

	<footer>


    </footer>


</body>
</html>
