<?php

   session_start();
   session_destroy();
   $url = 'Connexion.php';
   header('Location: ' . $url);


?>
