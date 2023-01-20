<?php
session_start();

include("DataBase.php");

  if(isset($_GET['id']) AND $_GET['id'] > 0){
     $getid = intval($_GET['id']);
      $requser = $bdd->prepare("SELECT * FROM membres WHERE id=? ");
      $requser->execute(array($getid));
      $userinfo = $requser->fetch();
  }

  if(empty( $_SESSION['id']))
  {
  	header('location:Connexion.php');
  }
  else
  {
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

       <div class="text-center">
           <div class="bg-primary container-fluid text-white">
              <h1><b><i>PROFIL de <?php echo $userinfo['nom'] ; ?></i></b></h1>
              <h1><b><i> <?php echo $userinfo['prenom'] ; ?></i></b></h1>
           </div >
            <h3>Bienvenu sur votre profil le connecté N° <?php echo $userinfo['id'] ; ?><br></h3>
            Nom = <?php echo $userinfo['nom'] ; ?><br>
           Mail = <?php echo $userinfo['mail'] ;?><br>
           Tel = <?php echo $userinfo['numTel'] ;?><br>
           Mot de passe =  <?php echo $userinfo['motdepass'] ;?>


        </div><br>
       <div class="text-center">
          <?php
          if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
          { ?>
             <a href="EditionProfil.php" class="btn btn-primary"><?php echo "Editer mon profil" ; ?></a>
             <a href="Deconnexion.php" class="btn btn-danger"><?php echo "Se deconnecter" ; ?></a>

         <?php } ?>
        </div>

    </section>

	<footer>


    </footer>


</body>
</html>
<?php
}
?>
