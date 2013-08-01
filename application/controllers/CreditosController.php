<?php

class CreditosController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->prepend('Créditos');
    }

    public function indexAction() {
        $usuarioModel = new Application_Model_DbTable_Usuario();
        $this->view->organizadores = $usuarioModel->getUsuariosOrganizador();
        $this->view->colaboradores = $usuarioModel->getUsuariosColaborador();
    }

}
