<!--
Fichier de traitement des donnée des formulaires du site pour envoie à la BD et gestion des ajout, modification, suppression à la base de données
-->

<?php
    require("config.php");

    /**
     * Connexion à la BD
     */
    function connexionBD(){
        $dsn="mysql:dbname=".BASE.";host=".SERVER;
        try{
            $connexion=new PDO($dsn,USER,PASSWD);
        }
        catch(PDOException $e){
            printf("Échec de la connexion : %s\n", $e->getMessage());
            exit();
        }
        return $connexion;
    }

    /**
     * Connexion à un compte utilisateur
     */
    function login($pass, $pseudo)
    {
        $connexion = connexionBD();
        $sql = "SELECT idUt, mdpUt FROM UTILISATEUR WHERE pseudoUt = :pseudo";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            foreach ($stmt as $row); 
            if(sha1($pass) == $row["mdpUt"]){
                $_SESSION['id'] = $row["idUt"];
                header('Location: ../index.php');
            }
            else{
                $info = "
                        <div class='alert alert-danger' role='alert'>
                            Mot de passe incorrecte !
                        </div>";
            }
            }
        else {
            $info = "
                    <div class='alert alert-danger' role='alert'>
                        pseudo introuvable !
                    </div>";
        }
        $stmt -> closecursor();
        return $info;
    }

    /**
     * Inscription d'un utilisateur
     */
    function register($pseudo, $pass1, $pass2, $mail1, $mail2)
    {
        $p = $pseudo;
        $pass = $pass2;
        $m = $mail2;
        if($pass1 == $pass2){
            if($mail1 == $mail2){
                $connexion = connexionBD();

                $verifPseudo="SELECT COUNT(pseudoUt) nb FROM UTILISATEUR WHERE pseudoUt= :pseudo";
                $stmt = $connexion->prepare($verifPseudo);
                $stmt->bindParam(':pseudo', $pseudo);
                $stmt->execute();
                
                foreach ($stmt as $row);

                if(intval($row['nb'])==0){
                    $passcrypt = sha1($pass2);
                    $sql = "INSERT INTO UTILISATEUR(idUt, pseudoUt, mdpUt, emailUt)
                    SELECT MAX(idUt)+1, :pseudo, :mdp, :mail FROM UTILISATEUR";
                    $stmt2 = $connexion->prepare($sql);
                    $stmt2->bindParam(':pseudo', $p);
                    $stmt2->bindParam(':mdp', $passcrypt);
                    $stmt2->bindParam(':mail', $m);
                    $stmt2->execute();
                

                    $stmt2 -> closecursor();
                    $info = "
                            <div class='alert alert-success' role='alert'>
                                Votre compte a été creer !
                            </div>";
                }
                else{
                    $info = "
                            <div class='alert alert-warning' role='alert'>
                                Le compte existe déjà !
                            </div>";
                }
                }else{
                $info = "
                        <div class='alert alert-danger' role='alert'>
                            Email incorrecte !
                        </div>";
                }
            }else{
                $info = "
                        <div class='alert alert-danger' role='alert'>
                            Mot de passe incorrecte !
                        </div>";
            }
        return $info;
    }

    /**
     * Affichage de la liste des film d'un utilisateur
     */
    function getListeFilm($id)
    {

        $connexion = connexionBD();

        $movie="SELECT * FROM FILM WHERE idUt=:id";
        $stmt = $connexion->prepare($movie);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            foreach ($stmt as $row)
            {
                echo "<div id='film'>
                            <h1>".$row["titreFilm"]."</h1>             
                     <h3>".$row['nomRea']."</h3>
                     <img src='".$row["imageFilm"]."'>
                            <div id='about'>
                            <button type='submit' onclick='pop(".$row['idFilm'].")' name='".$row['idFilm']."' class='btn btn-primary'>Modifier</button>
                            </div>    
                        </div>";
            }
        }
        else{
            echo "<div id='film'>
                    <h1>VOUS N'AVEZ AUCUN FILM</h1>
                 ";
        }
        
    }

    /**
     * Affichage de tout les films
     */
    function recupFilm()
    {
        //SELECT NomRea, titreFilm, imageFilm FROM FILM NATURAL JOIN REALISATEUR NATURAL JOIN REALISER;

        $connexion = connexionBD();
        $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM;";
        
        foreach ($connexion->query($movie) as $row)
        {
            echo "<div id='film'>
                        <h1>".$row["titreFilm"]."</h1>             
                    <h3>".$row['nomRea']."</h3>
                    <img src='".$row["imageFilm"]."'>
                        <div id='about'>
                        <button type='submit' onclick='pop(".$row['idFilm'].")' name='".$row['idFilm']."' class='btn btn-primary'>A propos</button>
                        </div>    
                    </div>";
        }
        
    }

    /**
     * Affichage des films par genre
     */
    function recupFilmParGenre($id)
    {
        //SELECT NomRea, titreFilm, imageFilm FROM FILM NATURAL JOIN GENRE WHERE idG = id;

        $connexion = connexionBD();
        $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM NATURAL JOIN GENRE WHERE idG = :id";
        $stmt = $connexion->prepare($movie);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            foreach ($stmt as $row)
            {
                echo "<div id='film'>
                            <h1>".$row["titreFilm"]."</h1>             
                    <h3>".$row['nomRea']."</h3>
                    <img src='".$row["imageFilm"]."'>
                            <div id='about'>
                            <button type='submit' onclick='pop(".$row['idFilm'].")' name='".$row['idFilm']."' class='btn btn-primary'>A propos</button>
                            </div>    
                        </div>";
            }
        }
        else {
            echo "
            <div id='genreNotFound'>
                <h1>Aucun film de ce genre !</h1>
            </div>";
        }
    }

    /**
     * Recuperation des informations detaillés d'un film et affichage dans une POPup
     */
    function getFilm($id)
    {
        //SELECT * FROM FILM NATURAL JOIN REALISATEUR NATURAL JOIN REALISER WHERE idFilm = :id;

        $connexion = connexionBD();
        $sql = "SELECT * FROM FILM NATURAL JOIN GENRE WHERE idFilm = :id;";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        foreach ($stmt as $row);

        echo "<div id='infoGeneral'>
             <img src='".$row['imageFilm']."'>
             <div id='infotext'>
             <ul>
             <li>Titre du film : ".$row['titreFilm']."</li>
             <li>Realisateur: ".$row['nomRea']." ".$row['prenomRea']."</li>
             <li>Genre: ".$row['nomGenre']."</li>
             <li>Année de realisation : ".$row['anneeRealisation']."</li>
             </ul>
             </div>
             </div>
             
             <div id='resume'>
                <div class='card'>
                    <div class='card-header'>
                    <h4 class='card-title'>Resumer</h4>
                    </div>
                    <div class='card-body'>
                        ".$row['resumerFilm']."
                    </div>
                </div> 
            </div>";
    }

    /**
     * Renvoie le titre de tout les films
     */
    function getTitreFilm()
    {
        $connexion = connexionBD();

        $sql = "SELECT titreFilm FROM FILM";

        return $connexion->query($sql);
    }

    /**
     * Renvoie si l'utilisateur peut ou non modifier le film
     */
    function verifAutorisationEditFilm($idUser, $idFilm)
    {
        $connexion = connexionBD();
        $sql = "SELECT * FROM FILM WHERE idUt = :idU AND idFilm = :idF";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':idU', $idUser);
        $stmt->bindParam(':idF', $idFilm);
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Recuperation des info du film à modifier
     */
    function infoFilmEdit($idFilm)
    {
        $connexion = connexionBD();
        $sql = "SELECT * FROM FILM WHERE idFilm = :id;";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $idFilm);
        $stmt->execute();

        foreach ($stmt as $row);

        return $row;
    }

    // function getPseudo($id)
    // {
    //     $connexion = connexionBD();
    //     $sql = "SELECT pseudoUt FROM UTILISATEUR WHERE idUt = :id;";
    //     $stmt = $connexion->prepare($sql);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->execute();

    //     foreach($stmt as $row);

    //     return $row['pseudoUt'];
    // }

    /**
     * Recuperation de la liste des genres
     */
    function getGenres()
    {
        //SELECT nomGenre FROM GENRE;
        $connexion = connexionBD();
        $movie="SELECT nomGenre, idg FROM GENRE;";
        return $connexion->query($movie);
    }

    /**
     * Ajout d'un film à la base de données
     */
    function ajouterFilm($titre, $image, $resumer, $annee, $nom, $prenom, $idg, $idut)
    {
        //INSERT INTO FILM(idFilm, titreFilm, imageFilm, resumerFilm, anneeRealisation, nomRea, prenomRea, idg, idUt)
        //SELECT MAX(idFilm)+1, :titre, :image, :resumer, :annee, :nom, :prenom, :idg, :idut FROM FILM
        $connexion = connexionBD();
        $sql = "INSERT INTO FILM(idFilm, titreFilm, imageFilm, resumerFilm, anneeRealisation, nomRea, prenomRea, idg, idUt)
                SELECT MAX(idFilm)+1, :titre, :image, :resumer, :annee, :nom, :prenom, :idg, :idut FROM FILM";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':resumer', $resumer);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':idg', $idg);
        $stmt->bindParam(':idut', $idut);
        $stmt->execute();

        $stmt -> closecursor();
        $info = "
                <div class='alert alert-success' role='alert'>
                    Votre film a été creer !
                </div>";
        
        return $info;
    }

    /**
     *  Suppression d'un film de la base de données
     */
    function supprimerFilm($id)
    {
        //DELETE FROM FILM WHERE idFilm=12
        $connexion = connexionBD();
        $sql = "DELETE FROM FILM WHERE idFilm=:id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * Modification des informations d'un film dans la base de données
     */
    function modifierFilm($titre,$image,$resumer,$annee,$nom,$prenom,$idg,$idFilm)
    {
        /**
         * UPDATE FILM
         * SET titreFilm = :titre, imageFilm = :image, resumerFilm = :resumer, anneeRealisation = :annee, nomRea = :nom, prenomRea = :prenom, idg = :idg
         * WHERE idFilm = :id
        **/
        $connexion = connexionBD();
        $sql =
        "
        UPDATE FILM
        SET titreFilm = :titre, imageFilm = :image, resumerFilm = :resumer, anneeRealisation = :annee, nomRea = :nom, prenomRea = :prenom, idg = :idg
        WHERE idFilm = :id
        ";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':resumer', $resumer);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':idg', $idg);
        $stmt->bindParam(':id', $idFilm);
        $stmt->execute();
    }

    /**
     * Recherche des films par rapport à une saisie
     */
    function rechercheFilm($string)
    {
        //SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM WHERE titreFilm LIKE "C%";

        $connexion = connexionBD();

        $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM WHERE titreFilm LIKE :val";
        $stmt = $connexion->prepare($movie);
        $stringValable = $string."%";
        $stmt->bindParam(':val', $stringValable);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            return $stmt;
        }
        else {
            return NULL;
        }
    }

    /**
     * Recherche des films par saisie et genre
     */
    function rechercheFilmByStyle($string,$idGenre)
    {
        //SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM WHERE titreFilm LIKE "C%";

        $connexion = connexionBD();

        $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM NATURAL JOIN GENRE WHERE idG=:genre AND titreFilm LIKE :val";
        $stmt = $connexion->prepare($movie);
        $stringValable = $string."%";
        $stmt->bindParam(':genre', $idGenre);
        $stmt->bindParam(':val', $stringValable);
        $stmt->execute();
        if($stmt->rowCount() > 0)
        {
            return $stmt;
        }
        else {
            return NULL;
        }
    }

    /**
     * Trie des films
     */
    function filtrerFilm($idFiltrage)
    {
        $connexion = connexionBD();
        switch($idFiltrage)
        {
            case (1): //A-Z
            //SELECT * FROM FILM ORDER BY titreFilm
            $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM ORDER BY titreFilm";
            $stmt = $connexion->prepare($movie);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                return $stmt;
            }
            else {
                return NULL;
            }

            case (2): //Annee
            //SELECT * FROM FILM ORDER BY anneeRealisation
            $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM ORDER BY anneeRealisation";
            $stmt = $connexion->prepare($movie);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                return $stmt;
            }
            else {
                return NULL;
            }

            case (3): //Realisateur
            //SELECT * FROM FILM ORDER BY nomRea, prenomRea 
            $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM ORDER BY nomRea, prenomRea";
            $stmt = $connexion->prepare($movie);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                return $stmt;
            }
            else {
                return NULL;
            }

            case (4): //Genre
            //SELECT * FROM FILM NATURAL JOIN GENRE ORDER BY nomGenre
            $movie="SELECT idFilm, titreFilm, imageFilm, nomRea FROM FILM NATURAL JOIN GENRE ORDER BY nomGenre";
            $stmt = $connexion->prepare($movie);
            $stmt->execute();
            if($stmt->rowCount() > 0)
            {
                return $stmt;
            }
            else {
                return NULL;
            }

            default:
                return NULL;
        }
    }

    /**
     * Affichage d'une liste de film
     */
    function getFilmByList($lsFilm)
    {
        if($lsFilm != NULL)
        {
            foreach ($lsFilm as $row)
            {
                echo "<div id='film'>
                            <h1>".$row["titreFilm"]."</h1>             
                    <h3>".$row['nomRea']."</h3>
                    <img src='".$row["imageFilm"]."'>
                            <div id='about'>
                            <button type='submit' onclick='pop(".$row['idFilm'].")' name='".$row['idFilm']."' class='btn btn-primary'>A propos</button>
                            </div>    
                        </div>";
            }
        }
        else {
            echo "
            <div id='genreNotFound'>
                <h1>Aucun film de ce nom !</h1>
            </div>";
        }
    }
    
?>