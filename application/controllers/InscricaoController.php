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

                $id_ouvinte = $ouvinteModel->insert($dados);

                $msg = $this->view->partial('/layout/templates/emailConfirmacao.phtml', array(
                    'nome' => $dados['nome']
                        ));

                try {
                    $mail = new Zend_Mail('utf-8');
                    $mail->setFrom('saadmlivramento@gmail.com')
                            ->setReplyTo('saadmlivramento@gmail.com')
                            ->addTo($dados['email'])
                            ->setBodyHtml($msg)
                            ->setSubject('Inscrição Semana Acadêmica 2011')
                            ->send(Zend_Registry::get('transport'));
                } catch (Exception $e) {
                    $date = new Zend_Date();
                    $emailPendenteModel = new Application_Model_DbTable_EmailPendente();
                    $emailPendenteModel->insert(array(
                        'id_ouvinte' => $id_ouvinte,
                        'data' => $date->get(Sistema_Data::DATABASE_DATETIME)
                    ));
                }

                $this->_redirect('/inscricao/sucesso');
            }
        }
        $this->view->inscricao = $inscricao;
    }

    public function sucessoAction() {
        // action body
    }

}

