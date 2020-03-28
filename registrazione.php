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
    <script src="assets/js/main.js"></script>
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
            <a class="navbar-brand" href="#">Covid-19</a>
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

      <div class="container-fluid wrapper full-height">
        <div class="container title full-height">

            
            <form method="POST" action="gestioneUtenti.php" id="login-form" autocomplete="off" style="width: 500px;" onsubmit="return check()">
                <input type="hidden" name="cmd" value="registrazione">
                <div class="form-group">
                  <label for="txtCF">CF</label>
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
                  <input type="password" required="true" class="form-control" id="txtPassword" name="txtPassword" placeholder="Es. Bfysu387">
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
</body>