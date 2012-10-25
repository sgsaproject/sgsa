<?php

/**
 * Description of CodigoBarrasTest
 *
 * @author Rafael
 */
class CodigoBarrasTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testGerarCodigoBarras() {
        $codigoBarrasModel = new Application_Model_CodigoBarra();
        $codigoBarras = $codigoBarrasModel->gerarCodigoBarras();
        $this->assertSame(strlen($codigoBarras), 5);
    }
    
    /*@var $usuario Application_Model_Usuario*/
    public function testExisteCodigoBarras() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setCodigoBarras(12345);
        $usuario->setIdTipoUsuario(1);
        $usuario->save();
        
        $codigoBarrasModel = new Application_Model_CodigoBarra();
        $existeCodigoBarras = $codigoBarrasModel->existeCodigoBarras(12345);
        
        $this->assertTrue($existeCodigoBarras);
    }
    
    /*@var $usuario Application_Model_Usuario*/
    public function testNaoExisteCodigoBarras() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuarioDAO->delete('codigo_barras = 12345');
        
        $codigoBarrasModel = new Application_Model_CodigoBarra();
        $existeCodigoBarras = $codigoBarrasModel->existeCodigoBarras(12345);
        
        $this->assertFalse($existeCodigoBarras);
    }

}

