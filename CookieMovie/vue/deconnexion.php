<!--
Fichier de deconnection d'un compte utilisateur
-->
<?php
  session_start();
  session_destroy();
  header('Location: ../index.php');
?>
