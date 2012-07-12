<?php

class Application_Model_DbTable_Palestra extends Zend_Db_Table_Abstract
{

    protected $_name = 'palestra';
    
    protected $_rowClass = 'Application_Model_Palestra';
    
    protected $_dependentTables = array('Application_Model_DbTable_Permissao',
        'Application_Model_DbTable_Sessao', 'Application_Model_DbTable_Permissao');
    
    protected $_referenceMap = array(
        'Sessao-Palestra' => array(
            'refTableClass' => 'Application_Model_DbTable_Sessao',
            'columns' => array('id_palestra'),
            'refColumns' => 'id_palestra'
        )
    );
    
    public function getPalestras(){
       $select = $this->select()->order('hora_inicio_prevista asc');
       return $this->fetchAll($select);
    }
    
    public function getPalestra($id_palestra){
       $select = $this->select()->where('id_palestra = ?',$id_palestra);
       return $this->fetchRow($select);
    }
    
    public function palestraFechada($id_palestra){
       $select = $this->select()->where('id_palestra = ?',$id_palestra);
       $row = $this->fetchRow($select);
       if(is_null($row)){
           return true;
       }else{
           if(empty($row->hora_fim)){
               return false;
           }else{
               return true;
           }
       }
    }
    
    public function getPalestraById($idPalestra) {
        return $this->find($idPalestra)->current();
    }

}

