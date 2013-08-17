<?php

class CredenciamentoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {

    }
    
    public function credenciarAction() {
        $usuarioDbTable = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDbTable->find($this->getRequest()->getParam('id_usuario'))->current();
        
        $fPagamentoDAO = new Application_Model_DbTable_FormaPagamento();
        $formasPagamento = $fPagamentoDAO->getFormasPagamento();
        
        
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getParams();
            if($data['acao'] == 'pagar'){
                
            }else if($data['acao'] == 'isentar'){
                
            }
        }
        
        $this->view->formasPagamento = $formasPagamento;
        $this->view->usuario = $usuario;
    }

    public function pagarAction() {
        
    }
    
    public function isentarAction() {
        
    }

}
