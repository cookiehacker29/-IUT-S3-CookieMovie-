<!--
Affichage de tout les films
Trie des films
Filtrage des films
-->

<!DOCTYPE html>
<html>
<head>
    <base href="../">
    <script>
    function pop(x) 
    {
        var myWindow = window.open("vue/aproposFilm.php?id="+x, "MsgWindow", "width=1200,height=600");
    }
    </script>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Films</title>
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
    
    <?php 
        require("../controleur/connexion.php");
        require("static/menu.php");
    ?>
    <div id="search">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form action="vue/films.php" method="POST" class="card card-sm bg-dark form-inline">
                        <div class="card-body row no-gutters align-items-center bg-dark">
                            <div class="col-auto">
                                <i class="fas fa-search h4 text-body"></i>
                            </div>
                            <div class="col">
                                <input name="string" list="filmLs" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Recherche d'un film">
                                <datalist id="filmLs">
                                <?php
                                foreach(getTitreFilm() as $row)
                                {
                                    echo "
                                    <option value='".$row["titreFilm"]."'>";
                                }
                                ?>
                                </datalist>
                            </div>
                            <div class="col">
                                <select name='idGenre' class= "form-control">
                                    <option value='-1'>Tout</option>
                                    <?php
                                    foreach(getGenres() as $row){    
                                        echo "<option value='".$row['idg']."'>".$row['nomGenre']."</option>";
                                        }
                                    ?>
                                </select>
                                </div>
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" type="submit">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="filtre">
                    <div class="container">
                        <form action="vue/films.php" method="POST" class="card card-sm bg-dark form-inline">
                            <label><h3>Trie</h3></label>
                            <select name='idfiltre' class= "form-control">
                                <option value='-1'>Aucun</option>
                                <option value='1'>A-Z</option>
                                <option value='2'>Date</option>
                                <option value='3'>Realisateur</option>
                                <option value='4'>Genre</option>
                            </select>
                            <button class="btn btn-lg btn-success" type="submit">Filtrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="liste">
        <div id="listeGenre">
            <div class='card text-white bg-secondary'>
                <div class='card-header'>
                    <h4 class='card-title'>Genres</h4>
                </div>
                <div class='card-body'>
                    <ul>
                        <li><a href="vue/films.php">Tout</a></li>
                        <?php
                            foreach(getGenres() as $row)
                            {
                                echo "<li><a href='vue/films.php?idGenre=".$row['idg']."'>".$row['nomGenre']."</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div> 
            
        </div>
    
        <div id="listeFilm">
            <?php 
            if(isset($_POST["string"]))
            {
                if($_POST['idGenre']>0)
                {
                    getFilmByList(rechercheFilmByStyle($_POST["string"], $_POST['idGenre']));
                }
                else
                {
                    getFilmByList(rechercheFilm($_POST["string"]));
                }
                
            }
            else if(isset($_GET['idGenre']))
            {
                recupFilmParGenre((int) $_GET['idGenre']);
            }

            else if(isset($_POST["idfiltre"]))
            {
                if($_POST['idfiltre']>0)
                {
                    getFilmByList(filtrerFilm($_POST["idfiltre"]));
                }
                else
                {
                    recupFilm();
                }
            }
            else
            {
                recupFilm();
            }
            ?>
        </div>
    </div>
</body>
</html>