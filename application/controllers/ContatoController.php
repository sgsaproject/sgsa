<?php

class ContatoController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->prepend('Contato');
    }

    public function indexAction() {
        $contato = new Application_Form_Contato();

        //verifica se há post
        if ($this->_request->isPost()) {
            //verifica se o formulario é valido, se não renderiza com os erros
            if ($contato->isValid($_POST)) {
                //pega os dados do post do formulario
                $dados = $contato->getValues();
                
                $contatoModel = new Application_Model_Contato();
                $contatoModel->setAttributes($dados);
                $contatoModel->enviarEmail();
                
                //cria uma mensagem de aviso no jquery q sera exibida apos o redirect
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem='Obrigado pelo seu contato, entraremos em contato breve!';
                //redireciona o usuario
                $this->_redirect('/contato/index');
            }
        }
        $this->view->contato = $contato;
    }
}