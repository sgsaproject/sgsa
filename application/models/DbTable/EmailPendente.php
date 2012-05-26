<?php

class Application_Model_DbTable_EmailPendente extends Zend_Db_Table_Abstract
{

    protected $_name = 'email_pendente';
    
    public function getEmail(){
        $select = $this->select()->order('data desc');
        return $this->fetchRow($select);
    }

}

