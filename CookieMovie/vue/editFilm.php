<!--
Popup d'édition d'un film
-->

<!DOCTYPE html>
<html>
<head>
    <base href="../">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="vue/css/design.css" />
    
</head>
<body>
    <div id='modifFilm'>
        <?php
            session_start();
            require("../controleur/connexion.php");
            if(verifAutorisationEditFilm($_SESSION['id'], $_GET['id']))
            {
                $_SESSION['idFilm'] = $_GET['id'];
                $row = infoFilmEdit($_GET['id']);
                echo 
                "
                <form action='modele/editFilm.php' method='POST'>
                    <div id='editFilm'>
                    <div>
                        <label for='titre'>Titre du film :</label>
                        <input value='".$row['titreFilm']."' type='text' name='titre' required>
                    </div>

                    <div>
                        <label for='image'>Image du film:</label>
                        <input value='".$row['imageFilm']."' type='text' name='image' required>
                    </div>

                    <div>
                        <label for='resumer'>Resumer du film:</label>
                        <input value=\"".$row['resumerFilm']."\" type='text' name='resumer' required>
                    </div>

                    <div>
                        <label for='annee'>Année de realisation :</label>
                        <input value='".$row['anneeRealisation']."' type='number' name='annee' required>
                    </div>

                    <div>
                        <label value='".$row['idg']."' for='genre'>Genre du film :</label>
                        <select name='genre'>";
                            foreach(getGenres() as $rowG)
                            {
                                if($row["idg"] == $rowG['idg'])
                                {
                                    echo "<option value=".$rowG['idg']." selected>".$rowG['nomGenre']."</option>";
                                } else {
                                    echo "<option value=".$rowG['idg'].">".$rowG['nomGenre']."</option>";
                                }
                                
                            }
                    echo
                    "
                            </select>
                        </div>
                        <div>
                            <label for='nomRea'>Nom du realisateur : </label>
                            <input type='text' name='nomRea' value='".$row['nomRea']."' required>
                        </div>

                        <div>
                            <label for='prenomRea'>Prenom du realisateur :</label>
                            <input value='".$row['prenomRea']."' type='text' name='prenomRea' required>
                        </div>

                        <button type='submit' name='edit' class='btn btn-secondary'>Modifier le film</button>
                        <button type='submit' name='delete' class='btn btn-danger'>Supprimer le film</button>
                    </form>
                    ";
            }
            else
            {
                echo
                "
                <div id=error>
                    <h1>Erreur accès non autorisé !</h1>
                </div>
                ";
            }
        ?>
    </div>
</body>
</html>