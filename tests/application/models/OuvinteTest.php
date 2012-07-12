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
    
    public function testGetSessoes() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $idOuvinte = $ouvinte->save();
        $ouvinte->setId_ouvinte($idOuvinte);
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setId_ouvinte($idOuvinte);
        $sessao->setId_palestra($idPalestra);
        $sessao->save();
        
        $sessao = $sessaoDAO->createRow();
        $sessao->setId_ouvinte($idOuvinte);
        $sessao->setId_palestra($idPalestra);
        $sessao->save();
        
        $sessoes = $ouvinte->getSessoes();
        $count = count($sessoes);
        
        $this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $sessoes);
        $this->assertEquals(2, $count);
    }

}