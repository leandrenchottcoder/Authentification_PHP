<?php 
//connexion a une base de donnee 
  try {
	$bdd = new PDO('mysql:host=localhost;dbname=membre;charset=utf8','root','root');
} catch(Exception $e){
	die('Erreur :'.$e->getMessage());
}
 echo '<h1><u><i>listes de membres </i> </u></h1>';
  	echo '
          <table border="1">
             <tr>
             <th>Id</th>
              <th>Pseudo</th>
              <th>Mail</th>
              <th>Mail2</th>
              <th>Mot de passe</th>
              <th>Mdp2</th>';
         
  $requete = $bdd->query('select * from  visiteurs');
  while ($donne = $requete->fetch()) {
 
         echo '
             <tr>
              <td>'.$donne['id'].'</td>
                <td>'.$donne['pseudo'].'</td>
                 <td>'.$donne['mail'].'</td>
                  <td>'.$donne['mail2'].'</td>
                   <td>'.$donne['motdepass'].'</td>
                    <td>'.$donne['mdp2'].'</td>
             </tr>
         ';
  }
  echo     '</tr>
          </table>';

          $requete->closeCursor();
  	


          
 
 //ajout un nouveau utilisateur

?>
<?php
   if (isset($_POST['envoyer']))
    {
		   	if (empty($_POST['pseudo']) AND empty($_POST['mail']) AND empty($_POST['mail2']) AND empty($_POST['mpd']) AND empty($_POST['mpd2'])) 
		   	{
		   		$erreur = " Tous les champs doivent être completés !!";
		   	}
		   	else
		   	{
		   		$pseudo = htmlspecialchars($_POST['pseudo']);
		   		$mail = htmlspecialchars($_POST['mail']);
		   		$mail2 = htmlspecialchars($_POST['mail2']);
		   		@$mdp = sha1($_POST['mdp']);
		   		$mdp2 = sha1($_POST['mdp2']);
		   		$requete = $bdd->prepare('insert into visiteurs(id , pseudo ,mail, motdepass,mail2,mdp2) values(?,?,?,?,?,?)');
		   		$requete->execute(array($id,$pseudo,$mdp,$mail,$mail2,$mdp2));
           

		   	}
   }
   if (@$_POST['mail'] == @$_POST['mail2'] )
      { 

   	   }
   	   else
   	   {
   	   	$erreur = "les deux Email ne correspondent pas !";
   	   }
   	   if (@$_POST['mdp']== @$_POST['mdp2'])
   	    {
   	   	
   	   }
   	   else
   	   {
   	   	$erreur = " Les deux mots de passe ne correspondent pas !";
   	   }
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>se connecter a une base de donner</title>
	<meta charset="utf-8">
</head>
<body>
  <div align="center">
  	<h2>Inscription</h2>
  	<br><br><br>
  	<form method="POST" action="tuto.php">
  		<table>
  			<tr>
  				<td align="right"><label for="pseudo">Pseudo : </label></td>
  				<td><input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo"></td>
  			</tr>
  			<tr>
  				<td align="right"><label for="mail">Mail : </label></td>
  				<td><input type="email" name="mail" id="mail" placeholder="Entrez votre mail"></td>
  			</tr>
  			<tr>
  				<td align="right"><label for="mail2">Confirmation du mail :</label></td>
  				<td><input type="email" name="mail2" id="mail2" placeholder="Votre mail de confirmation"></td>
  			</tr>
  			<tr>
  				<td align="right"><label for="mdp">Mot de passe :</label></td>
  				<td><input type="password" name="mpd" id="mpd" placeholder="Entrez votre mot de passe "></td>
  			</tr>
  			<tr>
  				<td align="right"><label for="mdp2">Confirmation du mot de passe :</label></td>
  				<td><input type="password" name="mdp2" id="mdp2" placeholder="Confirmez votre passe"></td>
  			</tr>
  			<tr>
  				<td></td>
  			</tr>
  			<tr>
  				<td></td>
  				<td align="center"><input type="submit" name="envoyer" value="je m'inscris"></td>
  			</tr>
  		</table>
  		<?php 
   if (isset($erreur)){
   	  echo '<font color="red">'.$erreur.'</font>';
   }
  ?>
  	</form>
  	
  </div> 
  
</body>
</html>