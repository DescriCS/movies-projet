<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="./asset/css/normalize.css">
    <link rel="stylesheet" href="./asset/css/bootstrap.css">
    <link rel="stylesheet" href="./asset/css/font-awesome.css">
    <link rel="stylesheet" href="./asset/css/style.css">
  </head>
  <body>

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded sticky-top">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <?php if (isLogged() === false) { ?>
            <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
          <?php } ?>
          <?php if (isLogged() === true) { ?>
            <li class="nav-item">
            <a class="nav-link" href="deconnexion.php">Deconnexion</a>
            </li>
          <?php } ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>


    <?php print_r($_SESSION); ?>
