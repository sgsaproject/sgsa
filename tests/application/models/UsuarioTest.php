<?php

class UsuarioTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testCriaObjeto() {
        $usuario = new Application_Model_Usuario();
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $usuario);
        $this->assertInstanceOf('Application_Model_Usuario', $usuario);
    }
    
    public function testGetId_tipo_usuario() {
        $usuarioDbTable = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDbTable->createRow();
        $usuario->setId_tipo_usuario(1); // id do administrador
        $tipoUsuario = $usuario->getTipoUsuario();
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $tipoUsuario);
        $this->assertInstanceOf('Application_Model_TipoUsuario', $tipoUsuario);
    }

}