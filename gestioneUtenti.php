<?php
if(!isset($_POST["cmd"]))
{
    header("location: index.php");
    return;
}


include "phpClass/ManagerDB.php";


if($_POST["cmd"] == "registrazione")
{
    $temp = new Utente($_POST["txtCF"], $_POST["txtNome"], $_POST["txtCognome"], $_POST["txtUsername"], $_POST["txtPassword"], null);


    $db = new ManagerDB();


    if($db->registrazione($temp))
    {
        header("location: login.php");
    }
    else
    {
        header("location: error.php?errore=erroreRegistrazione");
    }
}
?>