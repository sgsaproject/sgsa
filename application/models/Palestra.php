<?php

class Application_Model_Palestra extends Zend_Db_Table_Row_Abstract 
{
    private $usuarios;
    private $sessoes;
    
    public function getId() {
        return $this->id_palestra;
    }
    
    public function setId($idPalestra) {
        $this->id_palestra = $idPalestra;
    }
    
    public function getNomePalestra() {
        return $this->nome_palestra;
    }
    
    public function setNomePalestra($nomePalestra) {
        $this->nome_palestra = $nomePalestra;
    }
    
    public function getNomePalestrante() {
        return $this->nome_palestrante;
    }
    
    public function setNomePalestrante($nomePalestrante) {
        $this->nome_palestrante = $nomePalestrante;
    }
    
    public function getInstituicao() {
        return $this->instituicao;
    }
    
    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }
    
    public function getHoraInicioPrevista() {
        return $this->hora_inicio_prevista;
    }
    
    public function setHoraInicioPrevista($horaInicioPrevista) {
        $this->hora_inicio_palestra = $horaInicioPrevista;
    }
    
    public function getHoraFimPrevista() {
        return $this->hora_fim_prevista;
    }
    
    public function setHoraFimPrevista($horaFimPrevista) {
        $this->hora_fim_prevista = $horaFimPrevista;
    }
    
    public function getHoraInicio() {
        return $this->hora_inicio;
    }
    
    public function setHoraInicio($horaInicio) {
        $this->hora_inicio = $horaInicio;
    }
    
    public function getHoraFim() {
        return $this->hora_fim;
    }
    
    public function setHoraFim($horaFim) {
        $this->hora_fim = $horaFim;
    }
    
    public function getSala() {
        return $this->sala;
    }
    
    public function setSala($sala) {
        $this->sala = $sala;
    }
    
    public function getUsuariosComPermissao() {
        if (is_null($this->usuarios)) {
            $this->usuarios = $this->findManyToManyRowset('Application_Model_DbTable_Usuario',
                    'Application_Model_DbTable_Permissao');
        }
        return $this->usuarios;
    }
    
    public function getSessoes() {
        if (is_null($this->sessoes)) {
            $sessaoDAO = new Application_Model_DbTable_Sessao();
            $this->sessoes = $sessaoDAO->getSessoesOfPalestraById($this->id_palestra);
        }
        return $this->sessoes;
    }
}

