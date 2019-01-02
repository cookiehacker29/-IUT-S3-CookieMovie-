<!--
Page de connection à un compte utilisateur
-->

<!DOCTYPE html>
<html>
<head>
    <base href="../">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Connexion</title>
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
    <?php require("static/menu.php"); ?>
    <?php require("../modele/loginAccount.php"); ?>
    <div id="saisie">
      <form method="post" action="">
        <div class="form-group">
          <label for="pseudo">Pseudo</label>
          <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo" required>
        </div>
        <div class="form-group">
          <label>Mot de passe</label>
          <input type="password" class="form-control" name="pass" placeholder="Votre mot de passe" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Connection</button>
      </form>
      <?php echo "<div id='info'>".$info."</div>";?>
    </div>
</body>
</html>