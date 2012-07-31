<?php

class SessaoTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testCriaObjeto() {
        $sessao = new Application_Model_Sessao();
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $sessao);
        $this->assertInstanceOf('Application_Model_Sessao', $sessao);
    }
    
    public function testGetOuvinte() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setNome("Rafael Tavares Amorim");
        $ouvinte->setRg(12345678);
        $ouvinte->setEmail("zend@gmail.com");
        $ouvinte->setCurso("Engenharia de softs");
        $ouvinte->setInstituicao("Unipampa - Alegrete");
        $ouvinte->setCodigoBarras(11111);
        $id = $ouvinte->save();
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setIdOuvinte($id);
        $ouvinte2 = $sessao->getOuvinte();
        
        $this->assertNotNull($ouvinte2);
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $ouvinte2);
        $this->assertInstanceOf('Application_Model_Ouvinte', $ouvinte2);
        $this->assertEquals($id, $ouvinte2->getId());
    }
    
    public function testSetOuvinte() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setNome("Marcelo Maia Lopes");
        $ouvinte->setRg(87654321);
        $ouvinte->setEmail("minero.safado@gmail.com");
        $ouvinte->setCurso("Engenharia de Softs");
        $ouvinte->setInstituicao("Unipampa - Alegretchê!");
        $ouvinte->setCodigoBarras(22222);
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setOuvinte($ouvinte);
        $ouvinte2 = $sessao->getOuvinte();
        
        $this->assertNotNull($ouvinte2);
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $ouvinte2);
        $this->assertInstanceOf('Application_Model_Ouvinte', $ouvinte2);
        $this->assertEquals($ouvinte, $ouvinte2);
    }
    
    public function testGetPalestra() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Aprendendo Zeeeeeend");
        $palestra->setNomePalestrante("Rafael Tavares Amorim");
        $palestra->setInstituicao("Unipampa - Alegretchen");
        $palestra->setHoraInicioPrevista("31/07/2012 16:00:00");
        $palestra->setHoraFimPrevista("31/07/2012 18:00:00");
        $palestra->setHoraInicio("31/07/2012 16:03:10");
        $palestra->setHoraFim("31/07/2012 18:23:12");
        $palestra->setSala(201);
        
        $id = $palestra->save();
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setIdPalestra($id);
        $palestra2 = $sessao->getPalestra();
        
        $this->assertNotNull($palestra2);
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $palestra2);
        $this->assertInstanceOf('Application_Model_Palestra', $palestra2);
        $this->assertEquals($id, $palestra2->getId());
    }
    
    public function testSetPalestra() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Aprendendo Zeeeeeend");
        $palestra->setNomePalestrante("Rafael Tavares Amorim");
        $palestra->setInstituicao("Unipampa - Alegretchen");
        $palestra->setHoraInicioPrevista("31/07/2012 16:00:00");
        $palestra->setHoraFimPrevista("31/07/2012 18:00:00");
        $palestra->setHoraInicio("31/07/2012 16:03:10");
        $palestra->setHoraFim("31/07/2012 18:23:12");
        $palestra->setSala(201);
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setPalestra($palestra);
        $palestra2 = $sessao->getPalestra();
        
        $this->assertNotNull($palestra2);
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $palestra2);
        $this->assertInstanceOf('Application_Model_Palestra', $palestra2);
        $this->assertEquals($palestra, $palestra2);
    }
    
    public function testGetHoraEntrada() {
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setHoraEntrada("01/02/2012 20:00:00");
        $this->assertEquals("01/02/2012 20:00:00", $sessao->getHoraEntrada());
    }
    
    public function testSetHoraEntrada() {
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setHoraEntrada("01/02/2012 20:00:00");
        $this->assertEquals("2012-02-01 20:00:00", $sessao->hora_entrada);
    }
    
    public function testGetHoraSaida() {
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setHoraSaida("01/02/2012 20:00:00");
        $this->assertEquals("01/02/2012 20:00:00", $sessao->getHoraSaida());
    }
    
    public function testSetHoraSaida() {
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setHoraSaida("01/02/2012 20:00:00");
        $this->assertEquals("2012-02-01 20:00:00", $sessao->hora_saida);
    }
    
}