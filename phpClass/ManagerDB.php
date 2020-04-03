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
        $query = "SELECT * FROM utente WHERE CF = '" . $temp->getCF() . "' OR username = '" . $temp->getUsername() . "'";
        

        $result = $this->conn->query($query);
        if($result->num_rows >= 1)
        {
            return false;
        }


        $query = "INSERT INTO utente (CF, nome, cognome, username, password) VALUES ('" . $temp->getCF() . "', '" . $temp->getNome() ."', '" . $temp->getCognome() ."', '" . $temp->getUsername() . "', md5('" . $temp->getPassword() . "'))";
        $this->conn->query($query);


        return true;
    }


    public function login($username, $password)
    {
        $query = "SELECT * FROM utente WHERE username = '" . $username . "' AND password = md5('" . $password . "')";
        $result = $this->conn->query($query);

        while($row = $result->fetch_assoc())
        {
            return new Utente($row["CF"], $row["nome"], $row["cognome"], $row["username"], $row["password"], (int)$row["amministratore"]);
        }


        return null;
    }


    public function chiudiConnessione()
    {
        $this->conn->close();
    }
}
?>