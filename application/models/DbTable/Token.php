<?php

class Application_Model_DbTable_Token extends Zend_Db_Table_Abstract {

    protected $_name = 'token';
    
    protected $_rowClass = 'Application_Model_Token';
    
    public function existeToken($token) {
        $select = $this->select()->where('token = ?', $token);
        $token = $this->fetchRow($select);
        if ($token == null) {
            return false;
        }
        return true;
    }

}

