<?php
include "Utente.php";
class ManagerDB
{
    private $conn;


    public function __construct()
    {
        $this->conn = new mysqli("127.0.0.1", "root", "", "covid19_database");
    }


    public function registrazione(Utente $temp)
    {
        $ps = $this->conn->prepare("INSERT INTO utente (CF, nome, cognome, username, password) VALUES (?, ?, ?, ?, md5(?))");


        $ps->bind_param("sssss", $CF, $nome, $cognome, $username, $password);
        $CF = $temp->getCF();
        $nome = $temp->getNome();
        $cognome = $temp->getCognome();
        $username = $temp->getUsername();
        $password = $temp->getPassword();


        if(!$ps->execute())
        {
            return false;
        }


        return true;
    }


    public function chiudiConnessione()
    {
        $this->conn->close();
    }
}
?>