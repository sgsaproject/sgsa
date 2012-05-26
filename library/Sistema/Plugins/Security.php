<?php

class Sistema_Plugins_Security extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        //Verifica se há sessão
        if (Zend_Auth::getInstance()->hasIdentity()) {

            $identity = Zend_Auth::getInstance()->getIdentity();

            $rmanager = new Zend_Session_Namespace('rmanager');
            $id_projeto = $rmanager->projeto['id_projeto'];

            if (!empty($id_projeto)) {
                $usuariosProjetos = new Application_Model_DbTable_UsuariosProjetos();
                if (!$usuariosProjetos->IsAllowedUserProject($identity->id_usuario, $id_projeto)) {
                    $request->setControllerName('index');
                    $request->setActionName('selecionar-projeto');
                    $rmanager->projeto['id_projeto'] = null;
                }
            }
        }
    }

}