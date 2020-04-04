<?php
class Utente
{
    private $CF;
    private $nome;
    private $cognome;
    private $username;
    private $password;
    private $amministratore;


    public function __construct($CF, $nome, $cognome, $username, $password, $amministratore)
    {
        $this->CF = $CF;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->username = $username;
        $this->password = $password;
        $this->amministratore = $amministratore;
    }


    public function getCF()
    {
        return $this->CF;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getCognome()
    {
        return $this->cognome;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getAmministratore()
    {
        return $this->amministratore;
    }


    public function __toString()
    {
        return "Utente[CF=" . $this->CF . ", nome=" . $this->nome . ", cognome=" . $this->cognome . ", username=" . $this->username . ", password=" . $this->amministratore . ", amministratore=" . $this->amministratore . "]";
    }
}
?>