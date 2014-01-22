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
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_inicio_prevista);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setHoraInicioPrevista($horaInicioPrevista) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $horaInicioPrevista);
        $this->hora_inicio_prevista = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
    
    public function getHoraFimPrevista() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_fim_prevista);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setHoraFimPrevista($horaFimPrevista) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $horaFimPrevista);
        $this->hora_fim_prevista = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
    
    public function getHoraInicio() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_inicio);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setHoraInicio($horaInicio) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $horaInicio);
        $this->hora_inicio = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
    
    public function getHoraFim() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_fim);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setHoraFim($horaFim) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $horaFim);
        $this->hora_fim = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
    
    public function getDia() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_inicio);
        return $data->format(Sistema_Data::PHP_REGULAR_DATE);
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

