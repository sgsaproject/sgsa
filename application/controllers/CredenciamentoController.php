<?php

class CredenciamentoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $fPagamentoDAO = new Application_Model_DbTable_FormaPagamento();
        $formasPagamento = $fPagamentoDAO->getFormasPagamento();
        //$this->view->usuario = $usuario;
        $this->view->formasPagamento = $formasPagamento;
    }

    public function pagarAction() {
        
    }

}
