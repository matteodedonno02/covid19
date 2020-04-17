<?php
include "../phpClass/ManagerDB.php";
session_start();


if(!isset($_SESSION["loggedUser"]))
{
    header("location: ../index.php");
}


$loggedUser = $_SESSION["loggedUser"];


if(!$loggedUser->getAmministratore())
{
    header("location: ../index.php");
}


$db = new ManagerDB();
$loggedUser = $_SESSION["loggedUser"];


$temp = $db->listaMisurazioniAdmin();
$temp1 = $db->listaMisurazioniAdminCovid();


$listaUtenti = $temp[0];
$listaMisurazioni = $temp[1];


$listaUtentiCovid = $temp1[0];
$listaMisurazioniCovid = $temp1[1];


$db->chiudiConnessione();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19</title>
    <link rel="shortcut icon" href="../assets/img/virus.png" type="image/x-icon">


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
          <div class="table-responsive">
            <h3 style="margin-bottom: 20px; font-weight: bold;">Misurazioni Covid-19</h3>
            <?php
            if(count($listaMisurazioniCovid) == 0)
            {
            ?>
              <div class="alert alert-danger" role="alert">Al momento non ci sono misurazioni che interessano il Covid-19</div>
            <?php
            }
            else
            {
            ?>
              <table class="table">
                  <tr>
                      <td class="bold">CF</td>
                      <td class="bold">Nome</td>
                      <td class="bold">Cognome</td>
                      <td class="bold">Temperatura</td>
                      <td class="bold">Tosse secca</td>
                      <td class="bold">Difficoltà respiratorie</td>
                      <td class="bold">Data misurazione</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <?php
                  for($i = 0; $i < count($listaMisurazioniCovid); $i ++)
                  {
                  ?>
                      <tr>
                          <td><?php echo $listaUtentiCovid[$i]->getCF() ?></td>
                          <td><?php echo $listaUtentiCovid[$i]->getNome() ?></td>
                          <td><?php echo $listaUtentiCovid[$i]->getCognome() ?></td>                      
                          <td><?php echo $listaMisurazioniCovid[$i]->getTemperatura() ?> °C</td>
                          <td><?php echo $listaMisurazioniCovid[$i]->getTosseSecca() ? "Si" : "No" ?></td>
                          <td><?php echo $listaMisurazioniCovid[$i]->getDifficoltàRespiratoria() ? "Si" : "No" ?></td>
                          <td><?php echo strval($listaMisurazioniCovid[$i]->getDataMisurazione()) ?></td>
                          <td><a href="modifica-misurazione.php?cmd=edit&id=<?php echo $listaMisurazioniCovid[$i]->getIdMisurazione() ?>"><img class="crud-icon" src="../assets/img/edit.png"></a></td>
                          <td><a href="modifica-misurazione.php?cmd=del&id=<?php echo $listaMisurazioniCovid[$i]->getIdMisurazione() ?>"><img class="crud-icon" src="../assets/img/delete.png"></a></td>
                      </tr>
                  <?php
                  }
                  ?>
              </table>
            <?php
            }
            ?>
          </div>


          <div class="table-responsive">
            <h3 style="margin-bottom: 20px; font-weight: bold;">Tutte le misurazioni</h3>
            <?php
            if(count($listaMisurazioni) == 0)
            {
            ?>
              <div class="alert alert-danger" role="alert">Al momento non ci sono misurazioni</div>
            <?php
            }
            else
            {
            ?>
              <table class="table">
                  <tr>
                      <td class="bold">CF</td>
                      <td class="bold">Nome</td>
                      <td class="bold">Cognome</td>
                      <td class="bold">Temperatura</td>
                      <td class="bold">Tosse secca</td>
                      <td class="bold">Difficoltà respiratorie</td>
                      <td class="bold">Data misurazione</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                  </tr>
                  <?php
                  for($i = 0; $i < count($listaMisurazioni); $i ++)
                  {
                  ?>
                      <tr>
                          <td><?php echo $listaUtenti[$i]->getCF() ?></td>
                          <td><?php echo $listaUtenti[$i]->getNome() ?></td>
                          <td><?php echo $listaUtenti[$i]->getCognome() ?></td>
                          <td><?php echo $listaMisurazioni[$i]->getTemperatura() ?> °C</td>
                          <td><?php echo $listaMisurazioni[$i]->getTosseSecca() ? "Si" : "No" ?></td>
                          <td><?php echo $listaMisurazioni[$i]->getDifficoltàRespiratoria() ? "Si" : "No" ?></td>
                          <td><?php echo strval($listaMisurazioni[$i]->getDataMisurazione()) ?></td>
                      </tr>
                  <?php
                  }
                  ?>
              </table>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
</body>