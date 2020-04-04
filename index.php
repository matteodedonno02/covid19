<?php
include "phpClass/Utente.php";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19</title>
    <link rel="shortcut icon" href="assets/img/virus.png" type="image/x-icon">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Covid-19</a>
          </div>


          <?php
          session_start();
          if(!isset($_SESSION["loggedUser"]))
          {
          ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php">Login</a></li>
                <li><a href="registrazione.php">Registrazione</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          <?php
          }
          else
          {
            $loggedUser = $_SESSION["loggedUser"];
          ?>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="misurazione.php">Aggiungi misurazione</a></li>
                <li><a href="lista-misurazioni.php">Lista misurazioni</a></li>
                <li class="dropdown">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $loggedUser->getUsername(); ?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li>
                    <form action="gestioneUtenti.php" method="POST">
                        <input type="hidden" name="cmd" value="disconnetti">
                        <button type="submit" class="btn-link">Disconnetti</button>
                    </form>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          <?php
          }
          ?>
          
        </div><!-- /.container-fluid -->
      </nav>


      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
      
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active" style="background-image: url('assets/img/slider1.jfif');">
            <!-- <img src="..." alt="..."> -->
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item" style="background-image: url('assets/img/slider2.jfif');">
            <!-- <img src="..." alt="..."> -->
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item" style="background-image: url('assets/img/slider3.jfif');">
            <!-- <img src="..." alt="..."> -->
            <div class="carousel-caption">
            </div>
          </div>
        </div>
      
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <div class="container-fluid wrapper container-homepage">
        <div class="container title container-homepage">
            <h2>Covid-19</h2>
            <hr>
            <h4>Piattaforma di monitoraggio pazienti Covid-19</h4>
        </div>
      </div>
</body>
</html>