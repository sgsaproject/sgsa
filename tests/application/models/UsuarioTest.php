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
    
    public function testGetIdTipoUsuario() {
        $usuarioDbTable = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDbTable->createRow();
        $usuario->setIdTipoUsuario(1);
        $tipoUsuario = $usuario->getTipoUsuario();
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $tipoUsuario);
        $this->assertInstanceOf('Application_Model_TipoUsuario', $tipoUsuario);
    }
    
    public function testGetPalestrasComPermissao() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setIdTipoUsuario(1);
        $idUsuario = $usuario->save();

        $num = 2;
        for ($i = 0; $i < $num; $i++) {
            $palestraDAO = new Application_Model_DbTable_Palestra();
            $palestra = $palestraDAO->createRow();
            $idPalestra = $palestra->save();

            $permissao = new Application_Model_DbTable_Permissao();
            $data['id_usuario'] = $idUsuario;
            $data['id_palestra'] = $idPalestra;
            $permissao->insert($data);
        }
        
        $palestras = $usuario->getPalestrasComPermissao();
        $count = count($palestras);
        $this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $palestras);
        $this->assertEquals($num, $count);
    }

}