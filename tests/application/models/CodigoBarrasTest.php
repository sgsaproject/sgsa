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

}

