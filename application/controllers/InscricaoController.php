<?php

class InscricaoController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->prepend('Inscrição');
    }

    public function indexAction() {
         
    }

    public function inscreverAction() {
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
                $usuario->save();
                $usuario->enviarEmailConfirmacao();

                $this->_redirect('/inscricao/sucesso');
            }
        }
        $this->view->inscricao = $inscricao;
    }

    public function sucessoAction() {
        $this->view->headTitle()->prepend('Inscrição');
    }

}

