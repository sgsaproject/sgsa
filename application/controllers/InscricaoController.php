<?php

class InscricaoController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->prepend('Inscrição');
    }

    public function indexAction() {
         
    }

    public function inscreverAction() {
        $configuracaoModel = new Application_Model_DbTable_Configuracao();
        $this->view->configuracao = $configuracaoModel->find(1)->current();
        
        $inscricao = new Application_Form_Inscricao();
       
        //verifica se há post
        if ($this->_request->isPost()) {
            //verifica se o formulario é valido, se não renderiza com os erros
            if ($inscricao->isValid($_POST)) {
                //pega os dados do post do formulario
                $dados = $inscricao->getValues();
                //Inicia o modelo, insere os dados e redireciona
                $usuarioModel = new Application_Model_DbTable_Usuario();
                $codigoBarras = new Application_Model_CodigoBarra();
                /*@var $usuario Application_Model_Usuario*/
                $usuario = $usuarioModel->createRow();
                $usuario->setCodigoBarras($codigoBarras->gerarCodigoBarras());
                $usuario->setAttributes($dados);
                $usuario->setIdTipoUsuario(4);
                $usuario->data_criacao = (new \DateTime())->format('Y-m-d H:i:s');
                $usuario->data_modificacao = (new \DateTime())->format('Y-m-d H:i:s');
                $usuario->save();
                $usuario->enviarEmailAtivacao();

                $this->_redirect('/inscricao/sucesso');
            }
        }
        $this->view->inscricao = $inscricao;
    }
    
    public function ativarContaAction() {
        $this->view->headTitle()->prepend('Ativação de Conta');
        
        //$this->getRequest()->
        
    }

    public function sucessoAction() {
        $this->view->headTitle()->prepend('Inscrição');
    }

}

