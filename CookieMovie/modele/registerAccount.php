<!--
Traitement des informations du formulaire d'inscription
-->

<?php
    $info="";
    if(isset($_POST["submit"])){
        if (!empty($_POST["pseudo"]) && !empty($_POST["pass"]) &&
            !empty($_POST["pass2"]) && !empty($_POST["mail"]) && !empty($_POST["mail2"])) {
            
            include("../controleur/connexion.php");

            $pseudo = htmlspecialchars($_POST["pseudo"]);
            $pass = htmlspecialchars($_POST["pass"]);
            $pass2 = htmlspecialchars($_POST["pass2"]);
            $mail = htmlspecialchars($_POST["mail"]);
            $mail2 = htmlspecialchars($_POST["mail2"]);

            $info = register($pseudo, $pass, $pass2, $mail, $mail2);

        }else{
        $info = "
                <div class='alert alert-danger' role='alert'>
                    Formulaire incomplet !
                </div>";
        }
    }

?>
