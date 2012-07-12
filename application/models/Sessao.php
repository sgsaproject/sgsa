<?php

class Application_Model_Sessao extends Zend_Db_Table_Row_Abstract
{
    private $ouvinte;
    private $palestra;
    
    public function getId_sessao() {
        return $this->id_sessao;
    }
    
    public function setId_sessao($idSessao) {
        $this->id_sessao = $idSessao;
    }
    
    public function getId_ouvinte() {
        return $this->id_ouvinte;
    }
    
    public function setId_ouvinte($idOuvinte) {
        return $this->id_ouvinte = $idOuvinte;
    }
    
    public function getOuvinte() {
        if (is_null($this->ouvinte)) {
            $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
            $this->ouvinte = $ouvinteDAO->getOuvinteById($this->id_ouvinte);
        }
        return $this->ouvinte;
    }
    
    public function setOuvinte(Application_Model_Ouvinte $ouvinte) {
        $this->ouvinte = $ouvinte;
        $this->id_ouvinte = $ouvinte->getId_ouvinte();
    }

    public function getId_palestra() {
        return $this->id_palestra;
    }
    
    public function setId_palestra($idPalestra) {
        $this->id_palestra = $idPalestra;
    }
    
    public function getPalestra() {
        if (is_null($this->palestra)) {
            $palestraDAO = new Application_Model_DbTable_Palestra();
            $this->palestra = $palestraDAO->getPalestraById($this->id_palestra);
        }
        return $this->palestra;
    }
    
    public function setPalestra(Application_Model_Palestra $palestra) {
        $this->palestra = $palestra;
        $this->id_palestra = $palestra->getId_palestra();
    }
    
    public function getHora_entrada() {
        return $this->hora_entrada;
    }
    
    public function setHora_entrada($horaEntrada) {
        $this->hora_entrada = $horaEntrada;
    }
    
    public function getHora_saida() {
        return $this->hora_saida;
    }
    
    public function setHora_saida($horaSaida) {
        $this->hora_saida = $horaSaida;
    }
}

