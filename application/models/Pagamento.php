<?php

/**
 * Description of Pagamento
 *
 * @author Rafael
 */
class Application_Model_Pagamento extends Zend_Db_Table_Row_Abstract {

    use Sistema_Model_Utils;
    
    private $usuario;
    private $formaPagamento;
    
    public function getIdPagamento() {
        return $this->id_pagamento;
    }
    
    public function setIdPagamento($idPagamento) {
        $this->id_pagamento = $idPagamento;
    }
    
    public function getValor() {
        return $this->valor;
    }
    
    public function setValor($valor) {
        $this->valor = $valor;
    }
    
    public function getData() {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_DATABASE_DATETIME, $this->data);
        return $data->format(Sistema_Data::PHP_REGULAR_DATETIME);
    }
    
    public function setData($data) {
        $data = DateTime::createFromFormat(Sistema_Data::PHP_REGULAR_DATETIME, $data);
        $this->data = $data->format(Sistema_Data::PHP_DATABASE_DATETIME);
    }
    
    public function isIsento() {
        return $this->isento;
    }
    
    public function setIsento($isento) {
        $this->isento = $isento;
    }
    
    public function getObs() {
        return $this->obs;
    }
    
    public function setObs($obs) {
        $this->obs = $obs;
    }
    
    public function getIdUsuario() {
        return $this->id_usuario;
    }
    
    public function setIdUsuario($idUsuario) {
        $this->id_usuario = $idUsuario;
    }
    
    public function getIdFormaPagamento() {
        return $this->id_forma_pagamento;
    }
    
    public function setIdFormaPagamento($idFormaPagamento) {
        $this->id_forma_pagamento = $idFormaPagamento;
    }
    
    public function getUsuario() {
        if (is_null($this->usuario)) {
            $usuarioDAO = new Application_Model_DbTable_Usuario();
            $this->usuario = $usuarioDAO->getUsuarioById($this->id_usuario);
        }
        return $this->usuario;
    }
    
    public function getFormaPagamento() {
        if (is_null($this->formaPagamento)) {
            $fPagamentoDAO = new Application_Model_DbTable_FormaPagamento();
            $this->formaPagamento = $fPagamentoDAO->getFormaPagamentoById($this->id_forma_pagamento);
        }
        return $this->formaPagamento;
    }
    
}

