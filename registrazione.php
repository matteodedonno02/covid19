<?php
session_start();
if(isset($_SESSION["loggedUser"]))
{
    header("location: index.php");
}
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
    <script src="assets/js/codice.fiscale.var.js"></script>
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
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="login.php">Login</a></li>
              <li><a href="registrazione.php">Registrazione</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Calcolo CF</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" id="formCF" onsubmit="return calcolaCF();">
                  <div class="form-group">
                    <label for="nomeCF">Nome</label>
                    <input type="text" required="true" class="form-control" id="nomeCF">
                  </div>
                  <div class="form-group">
                    <label for="cognomeCF">Cognome</label>
                    <input type="text" required="true" class="form-control" id="cognomeCF">
                  </div>
                  <div class="form-group">
                    <label for="sessoCF">M <input type="radio" required="true" class="form-control" name="sessoCF" value="M"></label>
                  </div>
                  <div class="form-group">
                  <label for="sessoCF">F <input type="radio" required="true" class="form-control" name="sessoCF" value="F"></label>
                  </div>
                  <div class="form-group">
                    <label for="dataNascitaCF">Data di nascita</label>
                    <input type="date" required="true" class="form-control" id="dataNascitaCF">
                  </div>
                  <div class="form-group">
                    <label for="luogoNascitaCF">Luogo di nascita</label>
                    <input type="text" required="true" class="form-control" id="luogoNascitaCF">
                  </div>
                  <div class="form-group">
                    <label for="provinciaCF">Provincia (Sigla)</label>
                    <input type="text" required="true" class="form-control" id="provinciaCF">
                  </div>
                  <button type="submit" class="btn btn-default" id="calcolaCFButton">Calcola CF</button>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid wrapper full-height">
        <div class="container title full-height">
          <?php
          if(isset($_GET["errore"]))
          {
          ?>
              <div class="alert alert-danger" role="alert">Esiste già un account con lo stesso CF o con lo stesso username!</div>
          <?php
          }
          ?>
            <form method="POST" action="gestioneUtenti.php" id="login-form" autocomplete="off" style="width: 500px;" onsubmit="return check()">
                <input type="hidden" name="cmd" value="registrazione">
                <div class="form-group">
                  <label for="txtCF">CF</label> 
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" style="margin-bottom: 8px;">
                    Calcola CF
                  </button>
                  <input type="text" required="true" minlength="16" maxlength="16"  class="form-control" id="txtCF" name="txtCF" placeholder="CF">
                </div>
                <div class="form-group">
                  <label for="txtNome">Nome</label>
                  <input type="text" required="true" class="form-control" id="txtNome" name="txtNome" placeholder="Es. Mario">
                </div>
                <div class="form-group">
                  <label for="txtCognome">Cognome</label>
                  <input type="text" required="true" class="form-control" id="txtCognome" name="txtCognome" placeholder="Es. Rossi">
                </div>
                <div class="form-group">
                  <label for="txtUsername">Username</label>
                  <input type="text" required="true" class="form-control" id="txtUsername" name="txtUsername" placeholder="Es. mario32">
                </div>
                <div class="form-group">
                  <label for="txtPassword">Password</label>
                  <input type="password" required="true" class="form-control" id="txtPassword" name="txtPassword" placeholder="">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="accept-check"> Accetto di condividere i miei dati personali secondo le norme della privacy
                  </label>
                </div>
                <button type="submit" class="btn btn-default">Registrati</button>
              </form>
        </div>
      </div>


      
    <script src="assets/js/main.js"></script>
</body>