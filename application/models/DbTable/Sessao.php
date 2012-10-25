<?php

class Application_Model_DbTable_Sessao extends Zend_Db_Table_Abstract {

    protected $_name = 'sessao';
    
    protected $_rowClass = 'Application_Model_Sessao';
    
    protected $_dependentTables = array('Application_Model_DbTable_Usuario','Application_Model_DbTable_Palestra');
    
    protected $_referenceMap =  array(
        'SessaoUsuario'      => array(
            'refTableClass'  => 'Application_Model_DbTable_Usuario',
            'columns'        => array('id_usuario'),
            'refColumns'     => 'id_usuario'
        ),
        'SessaoPalestra'     => array(
            'refTableClass'  => 'Application_Model_DbTable_Palestra',
            'columns'        => array('id_palestra'),
            'refColumns'     => 'id_palestra'
        )
    );

    public function existeEntrada($id_palestra, $id_usuario) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('id_usuario = ?', $id_usuario)
                ->where('hora_entrada is not null');
        $row = $this->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function existeSaida($id_palestra, $id_usuario) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('id_usuario = ?', $id_usuario)
                ->where('hora_saida is not null');
        $row = $this->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function existeSessaoAbertaUsuario($id_usuario) {
        $select = $this->select()->where('id_usuario = ?', $id_usuario)
                ->where('hora_saida is null');
        $row = $this->fetchRow($select);
        if(is_null($row)){
            return false;
        }else{
            return true;
        }
    }
    
    public function getSessaoAbertaUsuario($id_usuario) {
        $select = $this->select()->where('id_usuario = ?', $id_usuario)
                ->where('hora_saida is null');
        $row = $this->fetchRow($select);
        if(is_null($row)){
           return null; 
        }else{
            return $row->id_palestra;
        }
    }

    public function getSessao($id_palestra, $id_usuario) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('id_usuario = ?', $id_usuario);
        return $this->fetchRow($select);
    }

    public function getUsuariosSessao($id_palestra) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->order('hora_entrada desc');
        return $this->fetchAll($select);
    }

    public function zerarEntradaUsuarios($id_palestra) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('hora_saida is null');
        $rows = $this->fetchAll($select);
        foreach ($rows as $row) {
            $date = new Zend_Date();
            $row->hora_entrada = $date->get(Sistema_Data::ZEND_DATABASE_DATETIME);
            $row->save();
        }
    }

    public function fechaSaidaUsuarios($id_palestra) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('hora_saida is null');
        $rows = $this->fetchAll($select);
        foreach ($rows as $row) {
            $date = new Zend_Date();
            $row->hora_saida = $date->get(Sistema_Data::ZEND_DATABASE_DATETIME);
            $row->save();
        }
    }
    
    public function getByData($data){
        $select = $this->select()->where("hora_entrada between '$data 00:00:00' and '$data 23:59:00'");
        return $this->fetchAll($select);
    }
    
    public function getSessoesOfUsuario(Application_Model_Usuario $usuario) {
        $this->getSessoesOfUsuarioById($usuario->getId_usuario());
    }
    
    public function getSessoesOfUsuarioById($idUsuario) {
        $select = $this->select()->where('id_usuario = ?', $idUsuario);
        return $this->fetchAll($select);
    }
    
    public function getSessoesOfPalestra(Application_Model_Palestra $palestra) {
        $this->getSessoesOfUsuarioById($palestra->getId_palestra());
    }
    
    public function getSessoesOfPalestraById($idPalestra) {
        $select = $this->select()->where('id_palestra = ?', $idPalestra);
        return $this->fetchAll($select);
    }

}

