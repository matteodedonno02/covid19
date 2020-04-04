<?php
class Misurazione
{
    private $idMisurazione;
    private $temperatura;
    private $tosseSecca;
    private $difficoltàRespiratoria;
    private $dataMisurazione;
    private $CF;

    public function __construct($idMisurazione, $temperatura, $tosseSecca, $difficoltàRespiratoria, $dataMisurazione, $CF)
    {
        $this->idMisurazione = $idMisurazione;
        $this->temperatura = $temperatura;
        $this->tosseSecca = $tosseSecca;
        $this->difficoltàRespiratoria = $difficoltàRespiratoria;
        $this->dataMisurazione = $dataMisurazione;
        $this->CF = $CF;
    }

    

    
    public function getIdMisurazione()
    {
        return $this->idMisurazione;
    }
    public function setIdMisurazione($idMisurazione)
    {
        $this->idMisurazione = $idMisurazione;

        return $this;
    }
    public function getTemperatura()
    {
        return $this->temperatura;
    }
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;

        return $this;
    }
    public function getTosseSecca()
    {
        return $this->tosseSecca;
    }
    public function setTosseSecca($tosseSecca)
    {
        $this->tosseSecca = $tosseSecca;

        return $this;
    }
    public function getDifficoltàRespitatoria()
    {
        return $this->difficoltàRespitatoria;
    }
    public function setDifficoltàRespitatoria($difficoltàRespitatoria)
    {
        $this->difficoltàRespitatoria = $difficoltàRespitatoria;

        return $this;
    }
    public function getDataMisurazione()
    {
        return $this->dataMisurazione;
    }
    public function setDataMisurazione($dataMisurazione)
    {
        $this->dataMisurazione = $dataMisurazione;

        return $this;
    }
    public function getCF()
    {
        return $this->CF;
    }
    public function setCF($CF)
    {
        $this->CF = $CF;

        return $this;
    }
}
?>