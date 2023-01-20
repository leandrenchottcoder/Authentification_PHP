<?php
session_start();

include("DataBase.php");

@$nom = $_POST['nom'];
@$prenom = $_POST['prenom'];
@$mail = $_POST['mail'];
@$numTel = $_POST['numTel'];
@$motdepass = $_POST['motdepass'];
@$valider = $_POST['valider'];
$erreur = "";
$resultat ="";

if(isset($valider)){

    if(!empty($nom) or !empty($prenom) or !empty($mail) or !empty($numTel) or !empty($motdepass)){

//           $resultat = 'merci '.$pseudo.' pour votre inscription';
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$mail = htmlspecialchars($_POST['mail']);
$numTel = htmlspecialchars($_POST['numTel']);
$motdepass = sha1($_POST['motdepass']);
//        $requete = $bdd->prepare('insert into membres(pseudo ,mail, motdepass) values(?,?,?)');
//        $requete->execute(array($pseudo,$mail,$motdepass));
//        $requpseudo = $bdd->prepare("select * from membres");
//        $requpseudo->execute(array($pseudo));
//        $pseudoexist = $requpseudo->rowCount();
        $requser = $bdd->prepare("SELECT * from membres WHERE nom =? AND prenom =? AND mail =? AND numTel =?  AND motdepass =?");
        $requser->execute(array($nom ,$prenom,$mail,$numTel,$motdepass));
        $userexist = $requser->rowCount();
         if($userexist == 1)
         {

            $userinfo = $requser->fetch();
             $_SESSION['id'] = $userinfo['id'];
             $_SESSION['nom'] = $userinfo['nom'];
             $_SESSION['prenom'] = $userinfo['prenom'];
              $_SESSION['mail'] = $userinfo['mail'];
              $_SESSION['numTel'] = $userinfo['numTel'];
              $_SESSION['motdepass'] = $userinfo['motdepass'];
             header("location: Profil.php?id= ".$_SESSION['id']);
         }
        else {
             $erreur = "Mauvais identifiant";
        }
    }
    else if(empty($nom) or empty($prenom) or empty($mail) or empty($numTel) or empty($motdepass))
    {

          $erreur =" veuillez  remplire tout les champs avant de vous connecter !!";


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

       <div align>
           <div class="bg-primary container-fluid text-white">
              <h1><b><i>CONNEXION</i></b></h1>
           </div>

         <form class="" method="post" action="Connexion.php">
            <div class="row" style="margin-left:50px">

                <div class="form-group">

                <input type="text" name="nom" value="<?php if(isset($nom)){ echo $nom ;} ?>"  placeholder="Nom" class="form-control">
                <input type="text" name="prenom" value="<?php if(isset($prenom)){ echo $prenom ;} ?>"  placeholder="Prenom" class="form-control">

                <input type="email" name="mail" value="<?php if(isset($mail)){ echo $mail ;} ?>" placeholder="Mail" class="form-control">

                <input type="text" name="numTel" value="" placeholder=" Tel"  class="form-control" maxlength="15">
                <input type="password" name="motdepass" value="" placeholder=" Mot de passe"  class="form-control" maxlength="15"><br>
               <div class="button-inline">
                  <button type="submit" class="btn btn-primary" name="valider"><b><i>Se connecter !</i></b></button>
                <button type="reset" class="btn btn-danger"><i><i>Effacer</i></b></button>
                   <a href="Inscription.php" class="btn btn-success">S'inscrire</a>
                </div>
           </div>

             </div>
           </form>
        </div>
    </section>
     <div class="bg-danger"> <?php
        if(isset($erreur)){
          echo'<font color=white>'.$erreur.'</font>';
        }
    ?></div>
   <div class="bg-primary"> <?php
        if(isset($resultat)){
      echo'<font color=white> '.$resultat.'</font>';
    }
    ?></div>
	<footer>


    </footer>


</body>
</html>
