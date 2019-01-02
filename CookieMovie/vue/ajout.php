<!--
Formulaire d'ajout de films
-->

<!DOCTYPE html>
<html>
<head>
    <base href="../">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creer un film</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="vue/css/design.css" />
</head>
<body>
    <?php
        require("static/menu.php");
        require("../modele/addFilm.php");
    ?>
    <form action="" method="POST">
        <div id="creerFilm">
            <div id="addfilm">
                <div class="card text-white bg-secondary" >
                    <div class="card-header">
                        <h3 class="card-title">Etape 1 : Creation du film</h3>
                    </div>
                    <div class="card-body">
                        <div id="saisieFilm">
                            <div>
                                <label for="titre">Titre du film :</label>
                                <input type="text" name="titre" required>
                            </div>

                            <div>
                                <label for="image">Image du film:</label>
                                <input type="text" name="image" required>
                            </div>

                            <div>
                                <label for="resumer">Resumer du film:</label>
                                <input type="text" name="resumer" required>
                            </div>

                            <div>
                                <label for="annee">Année de realisation :</label>
                                <input type="number" name="annee" required>
                            </div>

                            <div>
                                <label for="genre">Genre du film :</label>
                                <select name="genre">
                                    <?php
                                    foreach(getGenres() as $row)
                                    {
                                        echo "<option value=".$row['idg'].">".$row['nomGenre']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="addReal">
                <div class="card text-white bg-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Etape 2 : Ajout d'un realisateur</h3>
                    </div> 
                    <div class="card-body">
                        <div id="saisieReal">
                            <div>
                                <label for="nomRea">Nom du realisateur : </label>
                                <input type="text" name="nomRea" required>
                            </div>

                            <div>
                                <label for="prenomRea">Prenom du realisateur :</label>
                                <input type="text" name="prenomRea" required>
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" name="submit" class="btn btn-secondary">Ajouter le film</button>
                    <?php echo "<div id='info'>".$info."</div>";?>
                </div>
            </div>
            </div>
        </div>
    </form>
</body>
</html>