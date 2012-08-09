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
    
    /*@var $ouvinte Application_Model_Ouvinte*/
    public function testExisteCodigoBarras() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setCodigoBarras(12345);
        $ouvinte->save();
        
        $codigoBarrasModel = new Application_Model_CodigoBarra();
        $existeCodigoBarras = $codigoBarrasModel->existeCodigoBarras(12345);
        
        $this->assertTrue($existeCodigoBarras);
    }
    
    /*@var $ouvinte Application_Model_Ouvinte*/
    public function testNaoExisteCodigoBarras() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinteDAO->delete('codigo_barras = 12345');
        
        $codigoBarrasModel = new Application_Model_CodigoBarra();
        $existeCodigoBarras = $codigoBarrasModel->existeCodigoBarras(12345);
        
        $this->assertFalse($existeCodigoBarras);
    }

}

