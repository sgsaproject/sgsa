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
    
    public function testSetCodigoBarras() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setCodigoBarras(98765);
        $this->assertEquals(98765, $ouvinte->getCodigoBarras());
        
        try {
            $ouvinte->setCodigoBarras(-12345);
            $this->fail('Código de barras negativo');
        } catch (Application_Model_OuvinteException $e) {
            $this->assertEquals(98765, $ouvinte->getCodigoBarras());
        }
        
        try {
            $ouvinte->setCodigoBarras(123);
            $this->fail('Código de barras menor que o tamanho permitido');
        } catch (Application_Model_OuvinteException $e) {
            $this->assertEquals(98765, $ouvinte->getCodigoBarras());
        }
        
        try {
            $ouvinte->setCodigoBarras(123456);
            $this->fail('Código de barras maior que o tamanho permitido');
        } catch (Application_Model_OuvinteException $e) {
            $this->assertEquals(98765, $ouvinte->getCodigoBarras());
        }
    }

    public function testSaveOuvinte() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setCodigoBarras(66666);
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
        $ouvinte->setId($idOuvinte);
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setIdOuvinte($idOuvinte);
        $sessao->setIdPalestra($idPalestra);
        $sessao->save();
        
        $sessao = $sessaoDAO->createRow();
        $sessao->setIdOuvinte($idOuvinte);
        $sessao->setIdPalestra($idPalestra);
        $sessao->save();
        
        $sessoes = $ouvinte->getSessoes();
        $count = count($sessoes);
        
        $this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $sessoes);
        $this->assertEquals(2, $count);
    }
    
    /*@var $ouvinte Application_Model_Ouvinte*/
    public function testEnviarEmailConfirmacao() {
        Sistema_Test_Mail::clearMailFiles();
        
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setNome("Afonso Barbosa");
        $ouvinte->setEmail("thiagockrug@gmail.com");
        $codigoBarras = new Application_Model_CodigoBarra();
        $ouvinte->setCodigoBarras($codigoBarras->gerarCodigoBarras());
        $id = $ouvinte->save();
        $ouvinte->enviarEmailConfirmacao();
        
        $email = new Application_Model_DbTable_EmailPendente();
        $emails = $email->getEmailsOfOuvinte($id);
        $ouvinte2 = $ouvinteDAO->getOuvinteById($id);
        
        $this->assertNotNull($emails);
        $this->assertEquals(0, $emails->count());
        $this->assertEquals($id, $ouvinte2->getId());
        $this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $emails);
    }
    
    /*@var $ouvinte Application_Model_Ouvinte*/
    public function testEnviarEmailConfirmacaoEmailPendente() {
        Sistema_Test_Mail::clearMailFiles();
        
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setNome("Idelfonso Barbosa");
        $codigoBarras = new Application_Model_CodigoBarra();
        $ouvinte->setCodigoBarras($codigoBarras->gerarCodigoBarras());
        $id = $ouvinte->save();
        
        $ouvinte->enviarEmailConfirmacao();
        
        $email = new Application_Model_DbTable_EmailPendente();
        $emails = $email->getEmailsOfOuvinte($id);
        $ouvinte2 = $ouvinteDAO->getOuvinteById($id);
        
        $this->assertNotNull($emails);
        $this->assertEquals(1, $emails->count());
        $this->assertEquals($id, $ouvinte2->getId());
        $this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $emails);
    }
    
    protected function tearDown() {
        Sistema_Test_Mail::clearMailFiles();
        parent::tearDown();
    }

}