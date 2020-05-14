<?php
include "Utente.php";
include "Misurazione.php";
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


    public function registraMisurazione(Misurazione $temp)
    {
        $tosseSecca = $temp->getTosseSecca() ? 1 : 0;
        $difficoltàRespiratoria = $temp->getDifficoltàRespiratoria() ? 1 : 0;


        $query = "INSERT INTO misurazione VALUES (0, " . $temp->getTemperatura() . ", " . $tosseSecca . ", " . $difficoltàRespiratoria . ", '" . $temp->getDataMisurazione() . "', '" . $temp->getCF() . "')";


        $this->conn->query($query);
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


    public function listaMisurazioni($CF)
    {
        $listaMisurazioni = array();


        $query = "SELECT *, DATE_FORMAT(dataMisurazione,'%d/%m/%Y') as dataFormattata FROM misurazione WHERE CF = '" . $CF . "' ORDER BY dataMisurazione DESC";
        $result = $this->conn->query($query);
        while($row = $result->fetch_assoc())
        {
            $temp = new Misurazione($row["idMisurazione"], $row["temperatura"], $row["tosseSecca"], strval($row["difficoltàRespiratoria"]), $row["dataFormattata"], $row["CF"]);
            array_push($listaMisurazioni, $temp);
        }


        return $listaMisurazioni;
    }


    public function listaMisurazioniCovid($CF)
    {
        $listaMisurazioni = array();


        $query = "SELECT *, DATE_FORMAT(dataMisurazione,'%d/%m/%Y') as dataFormattata FROM misurazione WHERE CF = '" . $CF . "' AND temperatura >= 37 AND difficoltàRespiratoria = 1 ORDER BY dataMisurazione DESC";
        $result = $this->conn->query($query);
        while($row = $result->fetch_assoc())
        {
            $temp = new Misurazione($row["idMisurazione"], $row["temperatura"], $row["tosseSecca"], strval($row["difficoltàRespiratoria"]), $row["dataFormattata"], $row["CF"]);
            array_push($listaMisurazioni, $temp);
        }


        return $listaMisurazioni;
    }


    public function listaMisurazioniAdmin($search)
    {
        $listaUtenti = array();
        $listaMisurazioni = array();

        $search == "" ?
        $query = "SELECT *, DATE_FORMAT(m.dataMisurazione,'%d/%m/%Y') as dataFormattata FROM utente u INNER JOIN misurazione m ON u.CF = m.CF ORDER BY m.dataMisurazione DESC" :
        $query = "SELECT *, DATE_FORMAT(m.dataMisurazione,'%d/%m/%Y') as dataFormattata FROM utente u INNER JOIN misurazione m ON u.CF = m.CF WHERE u.nome LIKE '%" . $search . "%' OR u.cognome LIKE '%" . $search . "%' OR u.CF LIKE '%" . $search . "%' ORDER BY m.dataMisurazione DESC";
        $result = $this->conn->query($query);


        while($row = $result->fetch_assoc())
        {
            array_push($listaUtenti, new Utente($row["CF"], $row["nome"], $row["cognome"], $row["username"], $row["password"], (int)$row["amministratore"]));
            array_push($listaMisurazioni, new Misurazione($row["idMisurazione"], $row["temperatura"], $row["tosseSecca"], strval($row["difficoltàRespiratoria"]), $row["dataFormattata"], $row["CF"]));
        }


        return array($listaUtenti, $listaMisurazioni);
    }


    public function listaMisurazioniAdminCovid($search)
    {
        $listaUtenti = array();
        $listaMisurazioni = array();

        $search == "" ?
        $query = "SELECT *, DATE_FORMAT(m.dataMisurazione,'%d/%m/%Y') as dataFormattata FROM utente u INNER JOIN misurazione m ON u.CF = m.CF WHERE m.temperatura >= 37 AND m.difficoltàRespiratoria = 1 ORDER BY m.dataMisurazione DESC" :
        $query = "SELECT *, DATE_FORMAT(m.dataMisurazione,'%d/%m/%Y') as dataFormattata FROM utente u INNER JOIN misurazione m ON u.CF = m.CF WHERE m.temperatura >= 37 AND m.difficoltàRespiratoria = 1 AND (u.nome LIKE '%" . $search . "%' OR u.cognome LIKE '%" . $search . "%' OR u.CF LIKE '%" . $search . "%') ORDER BY m.dataMisurazione DESC";
        $result = $this->conn->query($query);


        while($row = $result->fetch_assoc())
        {
            array_push($listaUtenti, new Utente($row["CF"], $row["nome"], $row["cognome"], $row["username"], $row["password"], (int)$row["amministratore"]));
            array_push($listaMisurazioni, new Misurazione($row["idMisurazione"], $row["temperatura"], $row["tosseSecca"], strval($row["difficoltàRespiratoria"]), $row["dataFormattata"], $row["CF"]));
        }


        return array($listaUtenti, $listaMisurazioni);
    }


    public function cancellaMisurazione($id)
    {
        $query = "DELETE FROM misurazione WHERE idMisurazione = '" . $id . "'";
        $this->conn->query($query);
    }


    public function getMisurazione($id)
    {
        $query = "SELECT * FROM utente u INNER JOIN misurazione m ON u.CF = m.CF WHERE m.idMisurazione = '" . $id . "'";
        $reuslt = $this->conn->query($query);


        $misurazione;
        $utente;


        while($row = $reuslt->fetch_assoc())
        {
            $utente = new Utente($row["CF"], $row["nome"], $row["cognome"], $row["username"], $row["password"], (int)$row["amministratore"]);
            $misurazione = new Misurazione($row["idMisurazione"], $row["temperatura"], $row["tosseSecca"], strval($row["difficoltàRespiratoria"]), $row["dataMisurazione"], $row["CF"]);
            break;
        }


        return array($utente, $misurazione);
    }


    public function modificaMisurazione(Misurazione $misurazione)
    {
        $tosseSecca = $misurazione->getTosseSecca() ? 1 : 0;
        $difficoltàRespiratoria = $misurazione->getDifficoltàRespiratoria() ? 1 : 0;


        $query = "UPDATE misurazione SET dataMisurazione = '" . $misurazione->getDataMisurazione() . "', temperatura = " . $misurazione->getTemperatura() . ", tosseSecca = " . $tosseSecca . ", difficoltàRespiratoria = " . $difficoltàRespiratoria . " WHERE idMisurazione = " . $misurazione->getIdMisurazione();
        $this->conn->query($query);
    }


    public function chiudiConnessione()
    {
        $this->conn->close();
    }
}
?>