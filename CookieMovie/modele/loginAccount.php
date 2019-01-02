<!--
Traitement des informations du formulaire de connection
-->

<?php
$info = "";
require("../controleur/connexion.php");
if (isset($_POST["submit"])) {
  $pseudo = htmlspecialchars($_POST["pseudo"]);
  $pass = htmlspecialchars($_POST["pass"]);

  $info = login($pass, $pseudo);
}
?>
