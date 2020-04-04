<?php
if(!isset($_POST["cmd"]))
{
    header("location: index.php");
    return;
}


include "phpClass/ManagerDB.php";


switch ($_POST["cmd"])
{
    case "registraMisurazione":
        $tosseSecca = isset($_POST["txtTosseSecca"]) ? 1 : 0;
        $difficoltàRespiratoria = isset($_POST["txtDifficoltàRespiratoria"]) ? 1 : 0;


        session_start();
        $loggedUser = $_SESSION["loggedUser"];
        $temp = new Misurazione(null, $_POST["txtTemperatura"], $tosseSecca, $difficoltàRespiratoria, null, $loggedUser->getCF());


        
        $db = new ManagerDB();
        $db->registraMisurazione($temp);
        $db->chiudiConnessione();
        header("location: lista-misurazioni.php");
        break;
}
?>