<?php
include("Database.php");
@$nom = $_POST['nom'];
@$prenom = $_POST['prenom'];
@$mail = $_POST['mail'];
@$numTel = $_POST['numTel'];
@$motdepass = $_POST['motdepass'];
@$valider = $_POST['valider'];
$erreur = "";
$resultat ="";


if(isset($valider)){

    if(!empty($nom) or !empty($prenom) or !empty($mail) or !empty($numTel) or !empty($motdepass))
    {

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        $numTel = htmlspecialchars($_POST['numTel']);
        $motdepass = sha1($_POST['motdepass']);

        $requmail = $bdd->prepare("select * from membres WHERE mail=?");
        $requmail->execute(array($mail));
        $mailexist = $requmail->rowCount();

        if($mailexist == 0 )
        {
             $resultat = 'merci '.$nom.' '. $prenom.' pour votre inscription , votre compte a beelle et bien été créer';
             $requete = $bdd->prepare('insert into membres(nom , prenom, mail, numTel, motdepass) values(?,?,?,?,?)');
             $requete->execute(array($nom, $prenom,$mail, $numTel, $motdepass));
        }
        else
        {
          $erreur = "Mail deja utilisé , trouver vous un autre Mail . " ;
        }

    }
    else if(empty($nom) or empty($prenom) or empty($mail) or empty($numTel) or empty($motdepass))
    {
        $erreur = " Veuillez remplir tout les champs";
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
              <h1><b><i>INSCRIPTION</i></b></h1>
           </div>

         <form class="" method="post" action="Inscription.php">
            <div class="row" style="margin-left:50px">

                <div class="form-group">

                <label for="nom"><b><u><i>Nom</i></u></b></label>
                <input type="text" name="nom" value="<?php if(isset($nom)){ echo $nom ;} ?>" id="prenom" placeholder="votre Nom" class="form-control">
                <label for="prenom"><b><u><i>Prenom</i></u></b></label>
                <input type="text" name="prenom" value="<?php if(isset($prenom)){ echo $prenom ;} ?>" id="prenom" placeholder="votre Prénom" class="form-control">
                 <label for="mail"><b><u><i>Mail</i></u></b></label>
                <input type="email" name="mail" value="" placeholder="Votre Mail" id="mail" class="form-control">
                 <label for="numTel"><b><u><i>Numéro de téléphone</i></u></b></label>
                <input type="text" name="numTel" value="" placeholder="Votre tel" id="numTel" class="form-control">
                 <label for="motdepass"><b><u><i>Mot de passe</i></u></b></label>
                <input type="password" name="motdepass" value="" placeholder="Votre mot de passe" id="motdepass" class="form-control" maxlength="15"><br>
               <div class="button-inline">
                  <button type="submit" class="btn btn-primary" name="valider"><b><i>M'inscrire</i></b></button>
                <button type="reset" class="btn btn-danger"><i><i>Effacer</i></b></button>
                   <a href="Connexion.php" class="btn btn-success">Me connecter</a>
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
