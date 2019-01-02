<!--
Traitement du formaulaire pour la modification ou la suppression d'un film
-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="../vue/css/design.css" />

    <script language="javascript" type="text/javascript">
        function windowClose() 
        {
            window.open('','_parent','');
            window.close();
        }
    </script>
</head>
<body>
    <?php
    session_start();
    require "../controleur/connexion.php";
    if (isset($_POST["edit"]) & isset($_SESSION['id'])) {
        
        $titre = htmlspecialchars($_POST['titre']);
        $image = htmlspecialchars($_POST['image']);
        $resumer = htmlspecialchars($_POST['resumer']);
        $annee = htmlspecialchars($_POST['annee']);
        $nom = htmlspecialchars($_POST['nomRea']);
        $prenom = htmlspecialchars($_POST['prenomRea']);
        $idg = htmlspecialchars($_POST['genre']);
        $idFilm = $_SESSION['idFilm'];
        $idut = $_SESSION['id'];
        
        modifierFilm($titre, $image, $resumer, $annee, $nom, $prenom, $idg, $idFilm, $idut);

        echo 
        "
        <div id='film'><h1>FAIT !</h1></div>
        <center><input class='btn btn-dark' type='button' value='Fermer cette fenêtre' onclick='windowClose();'></center>
        ";
    }

    else if (isset($_POST["delete"]) & isset($_SESSION['id'])) {
        
        supprimerFilm($_SESSION['idFilm']);
        
        echo 
        "
        <div id='film'><h1>FAIT !</h1></div>
        <center><input class='btn btn-dark' type='button' value='Fermer cette fenêtre' onclick='windowClose();'></center>
        ";
    }
    ?>
</body>
</html>

