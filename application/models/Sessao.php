<?php

class Application_Model_Sessao extends Zend_Db_Table_Row_Abstract
{
    private $usuario;
    private $palestra;
    
    public function getId() {
        return $this->id_sessao;
    }
    
    public function setId($idSessao) {
        $this->id_sessao = $idSessao;
    }
    
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    
    public function setIdUsuario($idUsuario) {
        return $this->id_usuario = $idUsuario;
    }
    
    public function getUsuario() {
        if (is_null($this->usuario)) {
            $usuarioDAO = new Application_Model_DbTable_Usuario();
            $this->usuario = $usuarioDAO->getUsuarioById($this->id_usuario);
        }
        return $this->usuario;
    }
    
    public function setUsuario(Application_Model_Usuario $usuario) {
        $this->usuario = $usuario;
        $this->id_usuario = $usuario->getId();
    }

    public function getIdPalestra() {
        return $this->id_palestra;
    }
    
    public function setIdPalestra($idPalestra) {
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
        $this->id_palestra = $palestra->getId();
    }
    
    public function getHoraEntrada() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_entrada);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setHoraEntrada($horaEntrada) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $horaEntrada);
        $this->hora_entrada = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
    
    public function getHoraSaida() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->hora_saida);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setHoraSaida($horaSaida) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $horaSaida);
        $this->hora_saida = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
}

