<?php
if(!isset($_POST["cmd"]))
{
    header("location: index.php");
    return;
}


include "phpClass/ManagerDB.php";


switch ($_POST["cmd"])
{
    case "registrazione":
        $temp = new Utente($_POST["txtCF"], $_POST["txtNome"], $_POST["txtCognome"], $_POST["txtUsername"], $_POST["txtPassword"], null);


        $db = new ManagerDB();

        
        $result = $db->registrazione($temp);
        $db->chiudiConnessione();


        if($result)
        {
            header("location: login.php");
        }
        else
        {
            header("location: registrazione.php?errore=erroreRegistrazione");
        }


        break;
    case "login":
        $username = $_POST["txtUsername"];
        $password = $_POST["txtPassword"];


        $db = new ManagerDB();
        $result = $db->login($username, $password);
        $db->chiudiConnessione();


        if($result != null)
        {
            session_start();
            $_SESSION["loggedUser"] = $result;
            header("location: index.php");
        }
        else
        {
            header("location: login.php?errore=erroreRegistrazione");
        }


        break;
    case "disconnetti":
        session_start();
        session_destroy();
        header("location: index.php");
        break;
}
?>