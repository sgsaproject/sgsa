<?php

class Application_Model_DbTable_FormaPagamento extends Zend_Db_Table_Abstract
{

    protected $_rowClass = 'Application_Model_FormaPagamento';
    protected $_name = 'forma_pagamento';
    
    public function getFormasPagamento(){
        $select = $this->select();
        return $this->fetchAll($select);
    }
    
    public function getFormaPagamentoById($idFormaPagamento) {
        return $this->find($idFormaPagamento)->current();
    }
    
}

