<?php

class Sistema_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $acl = new Zend_Acl();

        $tiposusuario = new Application_Model_DbTable_TipoUsuario();
        $roles = $tiposusuario->getTipoUsuario();
        foreach ($roles as $role) {
            $acl->addRole(new Zend_Acl_Role($role->alias));
        }


        $zf = new Sistema_ZFInfo(APPLICATION_PATH);
        $controllers = $zf->listarControllers();

        foreach ($controllers as $controller) {
            $acl->add(new Zend_Acl_Resource($controller));
        }




        //Administrador
        $acl->allow('administrador', $controllers);


        //nao registrado
        $acl->allow(null, $controllers);
        $acl->deny(null, 'admin');
        $acl->allow(null, 'admin', array('login', 'sair', 'acesso-negado'));


        //Colaborador
        $acl->allow('colaborador', $controllers);
        $acl->deny('colaborador', 'admin');
        $acl->allow('colaborador', 'admin', array('login', 'sair', 'acesso-negado',
            'palestras', 'gerenciar-palestra', 'index', 'iniciar-palestra', 'finalizar-palestra', 'tempo-corrente',
            'registrar-usuario-palestra', 'usuarios', 'ver-dados-usuario','usuarios-palestra'
        ));

        //Organizador

        $acl->allow('organizador', $controllers);
        $acl->deny('organizador', 'admin');
        $acl->allow('organizador', 'admin', array('login', 'sair', 'acesso-negado',
            'palestras', 'gerenciar-palestra', 'index', 'iniciar-palestra', 'finalizar-palestra', 'tempo-corrente',
            'registrar-usuario-palestra', 'usuarios', 'ver-dados-usuario','usuarios-palestra','adicionar-fiscal-palestra',
            'apagar-fiscal'
        ));
        



        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();

            $usuariosModel = new Application_Model_DbTable_Usuario();
            $row = $usuariosModel->find($identity->id_usuario)->current()->findDependentRowset('Application_Model_DbTable_TipoUsuario');
            $role = strtolower($row->current()->alias);
        } else {

            $role = null;
        }

        //salva a url de requisição para redirecionamento futuro
        $requested = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
        $base = Zend_Controller_Front::getInstance()->getBaseUrl();
        $redirUri = str_replace($base, '', $requested);
        $url = new Zend_Session_Namespace('url');
        $url->url = $redirUri;
        //fim

        $controller = $request->controller;
        $action = $request->action;
        
         if ($acl->has($controller) == false) {
            $request->setControllerName('error');
            $request->setActionName('error');
            return;
        }


        if (!$acl->isAllowed($role, $controller, $action)) {

            if ($role == null) {

                $request->setControllerName('admin');
                $request->setActionName('login');
            } else {

                $request->setControllerName('admin');
                $request->setActionName('acesso-negado');
            }
        }
    }

}