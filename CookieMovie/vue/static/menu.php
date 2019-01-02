<!--
Genration barre de navigation
-->

<?php
  session_start();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
        $('a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active'); $(this).parents('li').addClass('active');
            }
        });
    });
</script>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="index.php">CookieMovie</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="vue/films.php">Nos films</a>
      </li>
      <?php
        if(empty($_SESSION['id'])){
          echo "
          <li class='nav-item'>\n
            <a class='nav-link' href='vue/login.php'>Connection</a>\n
          </li>\n
          <li class='nav-item'>\n
            <a class='nav-link' href='vue/inscription.php'>Inscription</a>\n
          </li>\n
          ";
        }
        else{
          echo "
          <li class='nav-item'>\n
            <a class='nav-link' href='vue/ajout.php'>Ajouter un film</a>\n
          </li>\n
          <li class='nav-item'>\n
            <a class='nav-link' href='vue/edition.php'>Gerer ces films</a>\n
          </li>\n
          <li class='nav-item'>\n
            <a class='nav-link' href='vue/deconnexion.php'>Deconnexion</a>\n
          </li>\n
          ";
        }
      ?>
    </ul>

  </div>
</nav>
