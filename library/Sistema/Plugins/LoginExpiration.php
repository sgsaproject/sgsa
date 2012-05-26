<?php

class Sistema_Plugins_LoginExpiration extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        //Verifica se há sessão
        if (Zend_Auth::getInstance()->hasIdentity()) {
            //Recupera sessão do zend auth
                $session = new Zend_Session_Namespace(Zend_Auth::getInstance()->getStorage()->getNamespace());
                //seta expiration time para 15 minutos
                $session->setExpirationSeconds(60 * 60);
        }
        //expira a sessão de configuração de projeto
        $session = new Zend_Session_Namespace('rmanager');
        $session->setExpirationSeconds(60 * 60);
        
    }

}