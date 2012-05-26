<?php

class AdminController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout->setLayout('admin');
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->view->identity = Zend_Auth::getInstance()->getIdentity();
        }
    }

    public function indexAction() {
        // action body
    }

    public function loginAction() {

        $login = new Application_Form_Login();

        if ($this->_request->isPost()) {
            if ($login->isValid($_POST)) {

                $dados = $login->getValues();

                $db = Zend_Db_Table::getDefaultAdapter();

                $authAdapter = new Zend_Auth_Adapter_DbTable(
                                $db,
                                'usuario',
                                'login',
                                'senha');

                $authAdapter->setIdentity($dados['login']);
                $authAdapter->setCredential($dados['senha']);

                $result = $authAdapter->authenticate();
                if ($result->isValid()) {

                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    $storage->write($authAdapter->getResultRowObject(array('id_usuario', 'nome', 'login', 'email', 'id_tipo_usuario')));
                } else {

                    $this->view->error = "Usuário ou senha incorreta!";
                }
            }
        }

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->logado = true;
            $identity = $auth->getIdentity();

            $this->_redirect('/admin');
        }

        $this->view->login = $login;
    }

    public function sairAction() {
        $authAdapter = Zend_Auth::getInstance();
        $authAdapter->clearIdentity();

        $sacta = new Zend_Session_Namespace('sacta');
        $sacta->unsetAll();
    }

    public function acessoNegadoAction() {
        
    }

    public function inserirEditarPalestraAction() {
        $form = new Application_Form_CadastroPalestra();
        $palestraModel = new Application_Model_DbTable_Palestra();
        //pega o id da palestra por post ou get
        $id_palestra = $this->getRequest()->getParam('id_palestra');

        //verifica se há um id de palestra, se há preenche o formulario para edição
        if (!empty($id_palestra)) {
            //busca no banco de dados, as informações da palestra atual
            $palestra = $palestraModel->find($id_palestra)->current()->toArray();

            $data_inicio = explode(' ', $palestra['hora_inicio_prevista']);
            $data_fim = explode(' ', $palestra['hora_fim_prevista']);

            $palestra['hora_inicio_prevista'] = $data_inicio[1];
            $palestra['hora_fim_prevista'] = $data_fim[1];

            $date = new Zend_Date($data_inicio[0]);
            $palestra['data_palestra'] = $date->get(Sistema_Data::REGULAR_DATE);


            //preenche o formulario
            $form->populate($palestra);
        }


        if ($this->_request->isPost()) {
            if ($form->isValid($_POST)) {

                $dados = $form->getValues();

                $inicio = $dados['data_palestra'] . ' ' . $dados['hora_inicio_prevista'];
                $fim = $dados['data_palestra'] . ' ' . $dados['hora_fim_prevista'];

                $date = new Zend_Date($inicio);
                $dados['hora_inicio_prevista'] = $date->get(Sistema_Data::DATABASE_DATETIME);

                $date = new Zend_Date($fim);
                $dados['hora_fim_prevista'] = $date->get(Sistema_Data::DATABASE_DATETIME);

                unset($dados['data_palestra']);

                if (!empty($id_palestra)) {
                    //update
                    $where = $palestraModel->getAdapter()->quoteInto('id_palestra = ?', $id_palestra);
                    $palestraModel->update($dados, $where);
                } else {
                    //insert
                    $palestraModel->insert($dados);
                }
                //cria uma mensagem de aviso no jquery q sera exibida apos o redirect
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Seu registro foi inserido/modificado com sucesso!';
                //redireciona o usuario
                $this->_redirect('/admin/palestras');
            }
        }
        $this->view->form = $form;
    }

    public function palestrasAction() {
        $palestraModel = new Application_Model_DbTable_Palestra();
        $this->view->palestras = $palestraModel->getPalestras();
    }

    public function relatoriosAction() {
        
    }

    public function usuariosAction() {
        $usuarioModel = new Application_Model_DbTable_Usuario();
        $this->view->usuarios = $usuarioModel->getUsuarios();
    }

    public function inserirEditarUsuarioAction() {
        $form = new Application_Form_Usuarios();
        $usuarioModel = new Application_Model_DbTable_Usuario();

        $id_usuario = $this->getRequest()->getParam('id_usuario');
        if (!empty($id_usuario)) {
            $usuario = $usuarioModel->find($id_usuario)->current();
            $form->populate($usuario->toArray());
        }

        if ($this->_request->isPost()) {
            if ($form->isValid($_POST)) {

                $dados = $form->getValues();

                if (!empty($id_usuario)) {
                    //update
                    $where = $usuarioModel->getAdapter()->quoteInto('id_usuario = ?', $id_usuario);
                    $usuarioModel->update($dados, $where);
                } else {
                    //insert
                    $usuarioModel->insert($dados);
                }
                //cria uma mensagem de aviso no jquery q sera exibida apos o redirect
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Seu registro foi inserido/modificado com sucesso!';
                //redireciona o usuario
                $this->_redirect('/admin/usuarios');
            }
        }

        $this->view->usuarios = $usuarioModel->getUsuarios();
        $this->view->form = $form;
    }

    public function apagarUsuarioAction() {

        $id_usuario = $this->getRequest()->getParam('id_usuario');
        $usuariosModel = new Application_Model_DbTable_Usuario();
        if (!empty($id_usuario)) {
            $usuariosModel->find($id_usuario)->current()->delete();
        }

        $info = new Zend_Session_Namespace('sacta');
        $info->mensagem = 'O usuário foi apagado com sucesso do sistema!';
        $this->_redirect('/admin/usuarios');
    }

    public function apagarPalestraAction() {

        $id_palestra = $this->getRequest()->getParam('id_palestra');
        $palestrasModel = new Application_Model_DbTable_Palestra();
        if (!empty($id_palestra)) {
            $palestrasModel->find($id_palestra)->current()->delete();
        }

        $info = new Zend_Session_Namespace('sacta');
        $info->mensagem = 'A palestra foi apagada com sucesso do sistema!';
        $this->_redirect('/admin/palestras');
    }

    public function gerenciarPalestraAction() {

        $id_palestra = $this->getRequest()->getParam('id_palestra');
        $palestraModel = new Application_Model_DbTable_Palestra();
        $this->view->palestra = $palestraModel->getPalestra($id_palestra);

        $permissaoModel = new Application_Model_DbTable_Permissao();
        if ($this->view->identity->id_tipo_usuario == 2) {
            if (!$permissaoModel->temPermissao($id_palestra, $this->view->identity->id_usuario)) {
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Você não tem permissão para gerenciar esta palestra, chame um organizador!';
                $this->_redirect('/admin/palestras');
            }
        }

        $sessaoModel = new Application_Model_DbTable_Sessao();
        $sessoes = $sessaoModel->getOuvintesSessao($id_palestra);
        $this->view->sessoes = $sessoes;
    }

    public function adicionarFiscalPalestraAction() {
        $form = new Application_Form_AdicionaFiscais();
        $modelSessao = new Application_Model_DbTable_Permissao();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $dados = $form->getValues();
                $id_palestra = $this->getRequest()->getParam('id_palestra');

                $dados['id_palestra'] = $id_palestra;

                $modelSessao->insert($dados);

                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Registro(s) atualizados com sucesso no sistema!';
                $this->_redirect('/admin/palestras');
            }
        }

        $this->view->fiscais = $form;
    }

    public function apagarFiscalAction() {

        $id_palestra = $this->getRequest()->getParam('id_palestra');
        $id_usuario = $this->getRequest()->getParam('id_usuario');

        $permissaoModel = new Application_Model_DbTable_Permissao();

        if (!empty($id_palestra) || !empty($id_usuario)) {
            $permissaoModel->deletar($id_palestra, $id_usuario);

            $info = new Zend_Session_Namespace('sacta');
            $info->mensagem = 'O fiscal foi apagado com sucesso do sistema!';
            $this->_redirect('/admin/palestras');
        }
    }

    public function ouvintesAction() {
        $filtro = $this->getRequest()->getParam('filtro');
        $ouvintesModel = new Application_Model_DbTable_Ouvinte();

        switch ($filtro) {
            case 'nao-pago':
                $this->view->ouvintes = $ouvintesModel->getOuvintesNaoPagos();
                $this->view->filtro = 'Ouvintes Não Pagos';
                break;
            case 'pago':

                $this->view->ouvintes = $ouvintesModel->getOuvintesPagos();
                $this->view->filtro = 'Ouvintes Pagos';
                break;
            case 'isento':

                $this->view->ouvintes = $ouvintesModel->getOuvintesIsentos();
                $this->view->filtro = 'Ouvintes Isentos';
                break;

            default:
                $this->view->ouvintes = $ouvintesModel->getOuvintes();
                break;
        }
    }

    public function alterarPagamentoAction() {

        $dados = $this->getRequest()->getParams();

        $ouvintesModel = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvintesModel->find($dados['id_ouvinte'])->current();
        $ouvinte->pagamento = $dados['pagamento'];
        $ouvinte->save();

        $info = new Zend_Session_Namespace('sacta');
        $info->mensagem = 'O pagamento do ouvinte ' . $ouvinte->nome . ' foi alterado com sucesso para ' . $this->view->FormatarPagamento($ouvinte->pagamento);
        $this->_redirect('/admin/ouvintes');
    }

    public function editarOuvinteAction() {

        $id_ouvinte = $this->getRequest()->getParam('id_ouvinte');
        $ouvintesModel = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvintesModel->find($id_ouvinte)->current();

        $form = new Application_Form_Inscricao();
        $form->populate($ouvinte->toArray());
        $form->getElement('email')->clearValidators();
        $form->getElement('enviar')->setLabel('Salvar');

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($_POST)) {
                $dados = $form->getValues();
                $ouvinte->setFromArray($dados);
                $ouvinte->save();
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'O ouvinte ' . $ouvinte->nome . ' teve seus dados alterados com sucesso!';
                $this->_redirect('/admin/ouvintes');
            }
        }
        $this->view->form = $form;
    }

    public function verDadosOuvinteAction() {
        $id_ouvinte = $this->getRequest()->getParam('id_ouvinte');
        $ouvinteModel = new Application_Model_DbTable_Ouvinte();
        $this->view->ouvinte = $ouvinteModel->find($id_ouvinte)->current();
    }

    public function relatorioCodigoBarrasNaoImpressoAction() {
        //$this->_helper->layout->disableLayout();
        $ouvinteModel = new Application_Model_DbTable_Ouvinte();
        $this->view->ouvintes = $ouvinteModel->getOuvintesNaoImpresso();
    }

    public function relatorioCodigoBarrasImpressoAction() {
        // action body
    }

    public function registrarOuvintePalestraAction() {
        $this->_helper->layout->disableLayout();
        $dados = $this->getRequest()->getParams();
        $sessaoModel = new Application_Model_DbTable_Sessao();
        $ouvinteModel = new Application_Model_DbTable_Ouvinte();
        $palestraModel = new Application_Model_DbTable_Palestra();
        $ouvinte = $ouvinteModel->getByCodigoBarras($dados['codigo_barras']);
        if (is_null($ouvinte)) {
            $this->view->mensagem = 'Codigo de Barras do Ouvinte inexistente!';
        } else {
            if ($sessaoModel->existeSessaoAbertaOuvinte($ouvinte->id_ouvinte) && $dados['id_palestra'] != $sessaoModel->getSessaoAbertaOuvinte($ouvinte->id_ouvinte)) {
                $this->view->mensagem = 'Ouvinte já está em outra palestra!';
            } else if ($palestraModel->palestraFechada($dados['id_palestra'])) {
                $this->view->mensagem = 'Esta palestra já foi finalizada!';
            } else {
                $date = new Zend_Date();
                if (!$sessaoModel->existeEntrada($dados['id_palestra'], $ouvinte->id_ouvinte)) {
                    $sessaoModel->insert(array(
                        'id_palestra' => $dados['id_palestra'],
                        'id_ouvinte' => $ouvinte->id_ouvinte,
                        'hora_entrada' => $date->get(Sistema_Data::DATABASE_DATETIME)
                    ));
                    $this->view->mensagem = 'Entrada do Ouvinte ' . $ouvinte->nome . ' Registrada!';
                } else if (!$sessaoModel->existeSaida($dados['id_palestra'], $ouvinte->id_ouvinte)) {
                    $sessao = $sessaoModel->getSessao($dados['id_palestra'], $ouvinte->id_ouvinte);
                    $sessao->hora_saida = $date->get(Sistema_Data::DATABASE_DATETIME);
                    $sessao->save();
                    $this->view->mensagem = 'Saída do Ouvinte ' . $ouvinte->nome . ' Registrada!';
                } else {
                    $this->view->mensagem = 'Saída do Ouvinte ' . $ouvinte->nome . ' Já Registrada!';
                }
            }
        }
    }

    public function ouvintesPalestraAction() {
        $this->_helper->layout->disableLayout();
        $dados = $this->getRequest()->getParams();
        $sessaoModel = new Application_Model_DbTable_Sessao();
        $sessoes = $sessaoModel->getOuvintesSessao($dados['id_palestra']);
        $this->view->sessoes = $sessoes;
    }

    public function iniciarPalestraAction() {

        $id_palestra = $this->getRequest()->getParam('id_palestra');
        $palestraModel = new Application_Model_DbTable_Palestra();
        if (!empty($id_palestra)) {

            $palestra = $palestraModel->find($id_palestra)->current();
            $date = new Zend_Date();
            if (empty($palestra->hora_inicio)) {
                $palestra->hora_inicio = $date->get(Sistema_Data::DATABASE_DATETIME);
                $palestra->save();
                $sessaoModel = new Application_Model_DbTable_Sessao();
                $sessaoModel->zerarEntradaOuvintes($id_palestra);

                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Palestra Iniciada com sucesso!';
                $this->_redirect('/admin/gerenciar-palestra/id_palestra/' . $id_palestra);
            } else {
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Palestra já foi iniciada!';
                $this->_redirect('/admin/gerenciar-palestra/id_palestra/' . $id_palestra);
            }
        }
    }

    public function finalizarPalestraAction() {

        $id_palestra = $this->getRequest()->getParam('id_palestra');
        $palestraModel = new Application_Model_DbTable_Palestra();

        if (!empty($id_palestra)) {
            $palestra = $palestraModel->find($id_palestra)->current();
            $date = new Zend_Date();
            if (empty($palestra->hora_fim)) {
                $palestra->hora_fim = $date->get(Sistema_Data::DATABASE_DATETIME);
                $palestra->save();
                $sessaoModel = new Application_Model_DbTable_Sessao();
                $sessaoModel->fechaSaidaOuvintes($id_palestra);
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Palestra Finalizada com sucesso!';
                $this->_redirect('/admin/gerenciar-palestra/id_palestra/' . $id_palestra);
            } else {
                $info = new Zend_Session_Namespace('sacta');
                $info->mensagem = 'Palestra já foi finalizada!';
                $this->_redirect('/admin/gerenciar-palestra/id_palestra/' . $id_palestra);
            }
        }
    }

    public function tempoCorrenteAction() {
        $this->_helper->layout->disableLayout();
        $id_palestra = $this->getRequest()->getParam('id_palestra');
        $palestraModel = new Application_Model_DbTable_Palestra();
        $palestra = $palestraModel->find($id_palestra)->current();

        if (empty($palestra->hora_fim)) {
            if (empty($palestra->hora_inicio)) {
                $this->view->time = 'Não iniciada!';
            } else {
                $date = new Zend_Date();
                $date->subTime($palestra->hora_inicio, Sistema_Data::DATABASE_DATETIME);
                $this->view->time = $date->get(Sistema_Data::REGULAR_TIME);
            }
        } else {
            $this->view->time = 'Palestra Finalizada!';
        }
    }

    public function relatorioOuvintesPalestrasAction() {

        $ouvintesModel = new Application_Model_DbTable_Ouvinte();
        $this->view->ouvintes = $ouvintesModel->getOuvintes();
    }

    public function deletarOuvinteAction() {

        $id_ouvinte = $this->getRequest()->getParam('id_ouvinte');
        $ouvintesModel = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvintesModel->find($id_ouvinte)->current();
        $ouvinte->delete();
        $info = new Zend_Session_Namespace('sacta');
        $info->mensagem = 'Ouvinte deletado com sucesso!';
        $this->_redirect('/admin/ouvintes');
    }

    public function relatorioPalestrasOuvintesAction() {
        $palestraModel = new Application_Model_DbTable_Palestra();
        $this->view->palestras = $palestraModel->getPalestras();
    }

    public function relatorioFinalAction() {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = 'select o.nome, (2 * count( * )  + 4) as total, o.id_ouvinte, o.email
                    from ouvinte o, sessao s, palestra p
                    where
                    o.id_ouvinte = s.id_ouvinte and
                    p.id_palestra = s.id_palestra
                    and s.id_palestra != 71
                    and s.id_palestra != 102
                    group by
                    1
                    order by
                    1;';

        $dbAdapter->beginTransaction();
        $result = $dbAdapter->fetchAll($select);

        $select2 = 'select o.id_ouvinte
            from ouvinte o, sessao s, palestra p
            where
            o.id_ouvinte = s.id_ouvinte and
            p.id_palestra = s.id_palestra and
            s.id_palestra = 102
            group by
            1
            order by
            1;';
        
        $result2 = $dbAdapter->fetchAll($select2);

	foreach ($result as $key => $ouvinte) {
            foreach ($result2 as $ouvinteAlmir) {
                if ($ouvinte['id_ouvinte'] == $ouvinteAlmir['id_ouvinte']) {
		    $result[$key]['total'] = $ouvinte['total'] + 4;
		}
            }
        }
        
//        foreach ($result as $ouvinte2) {
//            echo $ouvinte2['nome'].",".$ouvinte2['total'].",".$ouvinte2['email'];
//        }

        $this->view->result = $result;
    }

}

