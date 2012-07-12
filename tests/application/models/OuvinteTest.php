<?php

class OuvinteTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIsImpresso() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setImpresso(1);
        $this->assertTrue($ouvinte->isImpresso());
    }

    public function testSaveOuvinte() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setCodigo_barras(666666);
        $ouvinte->setCurso("Engenharia de Software");
        $ouvinte->setEmail("thiagockrug@gmail.com");
        $ouvinte->setImpresso(true);
        $ouvinte->setInstituicao("Unipampa");
        $ouvinte->setNome("Thiago Cassio Krug");
        $ouvinte->setPagamento("pago");
        $ouvinte->setRg("3093746001");
        $id = $ouvinte->save();
        $this->assertNotNull($id);
    }

}