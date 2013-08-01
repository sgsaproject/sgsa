<?php

/**
 * Description of FormaPagamento
 *
 * @author thiago
 */
class Application_Model_FormaPagamento extends Zend_Db_Table_Row_Abstract {
    
    use Sistema_Model_Utils;
    
    public function getIdFormaPagamento() {
        return $this->id_forma_pagamento;
    }
    
    public function setIdFormaPagamento($idFormaPagamento) {
        $this->id_forma_pagamento = $idFormaPagamento;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
}