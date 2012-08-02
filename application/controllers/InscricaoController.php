<?php

class InscricaoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
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
                $ouvinteModel = new Application_Model_DbTable_Ouvinte();
                $codigoBarras = new Application_Model_CodigoBarra();
                $dados['codigo_barras'] = $codigoBarras->gerarCodigoBarras();
                /*@var $ouvinte Application_Model_Ouvinte*/
                $ouvinte = $ouvinteModel->createRow();
                $ouvinte->setAttributes($dados);
                $ouvinte->save();
                $ouvinte->enviarEmailConfirmacao();

                $this->_redirect('/inscricao/sucesso');
            }
        }
        $this->view->inscricao = $inscricao;
    }

    public function sucessoAction() {
        // action body
    }

}

