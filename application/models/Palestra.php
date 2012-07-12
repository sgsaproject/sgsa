<?php

class Application_Model_Palestra extends Zend_Db_Table_Row_Abstract 
{
    public function getId_palestra() {
        return $this->id_palestra;
    }
    
    public function setId_palestra($idPalestra) {
        $this->id_palestra = $idPalestra;
    }
    
    public function getNome_palestra() {
        return $this->nome_palestra;
    }
    
    public function setNome_palestra($nomePalestra) {
        $this->nome_palestra = $nomePalestra;
    }
    
    public function getNome_palestrante() {
        return $this->nome_palestrante;
    }
    
    public function setNome_palestrante($nomePalestrante) {
        $this->nome_palestrante = $nomePalestrante;
    }
    
    public function getInstituicao() {
        return $this->instituicao;
    }
    
    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }
    
    public function getHora_inicio_prevista() {
        return $this->hora_inicio_prevista;
    }
    
    public function setHora_inicio_prevista($horaInicioPalestra) {
        $this->hora_inicio_palestra = $horaInicioPalestra;
    }
    
    public function getHora_fim_prevista() {
        return $this->hora_fim_prevista;
    }
    
    public function setHora_fim_prevista($horaFimPrevista) {
        $this->hora_fim_prevista = $horaFimPrevista;
    }
    
    public function getHora_inicio() {
        return $this->hora_inicio;
    }
    
    public function setHora_inicio($horaInicio) {
        $this->hora_inicio = $horaInicio;
    }
    
    public function getHora_fim() {
        return $this->hora_fim;
    }
    
    public function setHora_fim($horaFim) {
        $this->hora_fim = $horaFim;
    }
    
    public function getSala() {
        return $this->sala;
    }
    
    public function setSala($sala) {
        $this->sala = $sala;
    }
}

