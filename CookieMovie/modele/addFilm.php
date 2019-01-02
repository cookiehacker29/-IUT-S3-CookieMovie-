<!-- 
    Fichier permettant la récupération des données du formulaire d'ajout de film
-->

<?php
require("../controleur/connexion.php");
$info = "";
if (isset($_POST["submit"]) & isset($_SESSION['id'])) {
    
    $titre = htmlspecialchars($_POST['titre']);
    $image = htmlspecialchars($_POST['image']);
    $resumer = htmlspecialchars($_POST['resumer']);
    $annee = htmlspecialchars($_POST['annee']);
    $nom = htmlspecialchars($_POST['nomRea']);
    $prenom = htmlspecialchars($_POST['prenomRea']);
    $idg = htmlspecialchars($_POST['genre']);
    $idut = $_SESSION['id'];

    $info = ajouterFilm($titre, $image, $resumer, $annee, $nom, $prenom, $idg, $idut); // Envoie des information au fichier "connexion.php" pour l'ajout à la table film
}
?>