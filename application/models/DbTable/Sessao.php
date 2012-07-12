<?php

class Application_Model_DbTable_Sessao extends Zend_Db_Table_Abstract {

    protected $_name = 'sessao';
    
    protected $_rowClass = 'Application_Model_Sessao';
    
    protected $_dependentTables = array('Application_Model_DbTable_Ouvinte','Application_Model_DbTable_Palestra');
    
    protected $_referenceMap =  array(
        'SessaoOuvinte'      => array(
            'refTableClass'  => 'Application_Model_DbTable_Ouvinte',
            'columns'        => array('id_ouvinte'),
            'refColumns'     => 'id_ouvinte'
        ),
        'SessaoPalestra'     => array(
            'refTableClass'  => 'Application_Model_DbTable_Palestra',
            'columns'        => array('id_palestra'),
            'refColumns'     => 'id_palestra'
        )
    );

    public function existeEntrada($id_palestra, $id_ouvinte) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('id_ouvinte = ?', $id_ouvinte)
                ->where('hora_entrada is not null');
        $row = $this->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function existeSaida($id_palestra, $id_ouvinte) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('id_ouvinte = ?', $id_ouvinte)
                ->where('hora_saida is not null');
        $row = $this->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function existeSessaoAbertaOuvinte($id_ouvinte) {
        $select = $this->select()->where('id_ouvinte = ?', $id_ouvinte)
                ->where('hora_saida is null');
        $row = $this->fetchRow($select);
        if(is_null($row)){
            return false;
        }else{
            return true;
        }
    }
    
    public function getSessaoAbertaOuvinte($id_ouvinte) {
        $select = $this->select()->where('id_ouvinte = ?', $id_ouvinte)
                ->where('hora_saida is null');
        $row = $this->fetchRow($select);
        if(is_null($row)){
           return null; 
        }else{
            return $row->id_palestra;
        }
    }

    public function getSessao($id_palestra, $id_ouvinte) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('id_ouvinte = ?', $id_ouvinte);
        return $this->fetchRow($select);
    }

    public function getOuvintesSessao($id_palestra) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->order('hora_entrada desc');
        return $this->fetchAll($select);
    }

    public function zerarEntradaOuvintes($id_palestra) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('hora_saida is null');
        $rows = $this->fetchAll($select);
        foreach ($rows as $row) {
            $date = new Zend_Date();
            $row->hora_entrada = $date->get(Sistema_Data::DATABASE_DATETIME);
            $row->save();
        }
    }

    public function fechaSaidaOuvintes($id_palestra) {
        $select = $this->select()->where('id_palestra = ?', $id_palestra)
                ->where('hora_saida is null');
        $rows = $this->fetchAll($select);
        foreach ($rows as $row) {
            $date = new Zend_Date();
            $row->hora_saida = $date->get(Sistema_Data::DATABASE_DATETIME);
            $row->save();
        }
    }
    
    public function getByData($data){
        $select = $this->select()->where("hora_entrada between '$data 00:00:00' and '$data 23:59:00'");
        return $this->fetchAll($select);
    }
    
    public function getSessoesOfOuvinte(Application_Model_Ouvinte $ouvinte) {
        $this->getSessoesOfOuvinteById($ouvinte->getId_ouvinte());
    }
    
    public function getSessoesOfOuvinteById($idOuvinte) {
        $select = $this->select()->where('id_ouvinte = ?', $idOuvinte);
        return $this->fetchAll($select);
    }

}

