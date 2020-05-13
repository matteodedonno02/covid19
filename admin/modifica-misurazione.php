<?php
include "../phpClass/ManagerDB.php";
session_start();


if(!isset($_SESSION["loggedUser"]))
{
    header("location: ../index.php");
}


$loggedUser = $_SESSION["loggedUser"];


if(!$loggedUser->getAmministratore() || !isset($_GET["cmd"]))
{
    header("location: ../index.php");
}


if($_GET["cmd"] == "del")
{
    $db = new ManagerDB();
    $db->cancellaMisurazione($_GET["id"]);
    header("location: lista-misurazioni.php");
    $db->chiudiConnessione();
}

$db = new ManagerDB();
$utente = $db->getMisurazione($_GET["id"])[0];
$misurazione = $db->getMisurazione($_GET["id"])[1];
$tosseSecca = $misurazione->getTosseSecca() ? "checked" : "";
$difficoltàRespiratoria = $misurazione->getDifficoltàRespiratoria() ? "checked" : "";
$db->chiudiConnessione();


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
    <link rel="stylesheet" href="../assets/css/style.css">


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
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Effettua misurazione <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">per nuovo utente</a></li>
                        <li><a href="#">per utente già registrato</a></li>
                    </ul>
                </li>
                    <li><a href="lista-misurazioni.php">Lista misurazioni</a></li>
                    <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $loggedUser->getUsername(); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                        <form action="../gestioneUtenti.php" method="POST">
                            <input type="hidden" name="cmd" value="disconnetti">
                            <button type="submit" class="btn-link">Disconnetti</button>
                        </form>
                        </li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
      </nav>


      <div class="container-fluid wrapper full-height">
        <div class="container title full-height">
            <h3 style="margin-bottom: 20px; text-align: center; font-weight: bold;">Modifica misurazione di <?php echo ($utente->getNome() . " " . $utente->getCognome() . ", " . $utente->getCF()) ?></h3>
            <form method="POST" action="../gestioneMisurazioni.php" id="login-form" autocomplete="off" style="width: 500px; height: 200px;" onsubmit="return check()">
                <input type="hidden" name="cmd" value="modificaMisurazione">
                <input type="hidden" name="id" value="<?php echo $misurazione->getIdMisurazione(); ?>">
                <div class="form-group">
                  <label for="txtTemperatura">Temperatura corporea</label>
                  <input type="number" step="0.01" required="true" min="35" max="42" class="form-control" id="txtTemperatura" name="txtTemperatura" value="<?php echo $misurazione->getTemperatura() ?>">
                </div>
                <div class="form-group">
                  <label for="txtTosseSecca">Tosse secca</label>
                  <input type="checkbox" <?php echo $tosseSecca; ?> id="txtTosseSecca" name="txtTosseSecca" value="si">
                </div>
                <div class="form-group">
                  <label for="txtDifficoltàRespiratoria">Difficoltà respiratorio</label>
                  <input type="checkbox" <?php echo $difficoltàRespiratoria; ?> id="txtDifficoltàRespiratoria" name="txtDifficoltàRespiratoria" value="si">
                </div>
                <button type="submit" class="btn btn-default">Modifica</button>
              </form>
        </div>
      </div>
</body>