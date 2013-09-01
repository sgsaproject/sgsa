<?php

class UsuarioTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testIsImpresso() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setImpresso(1);
        $this->assertTrue($usuario->isImpresso());
    }
    
    public function testSetCodigoBarras() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setCodigoBarras(98765);
        $this->assertEquals(98765, $usuario->getCodigoBarras());
        
        try {
            $usuario->setCodigoBarras(-12345);
            $this->fail('Código de barras negativo');
        } catch (Application_Model_UsuarioException $e) {
            $this->assertEquals(98765, $usuario->getCodigoBarras());
        }
        
        try {
            $usuario->setCodigoBarras(123);
            $this->fail('Código de barras menor que o tamanho permitido');
        } catch (Application_Model_UsuarioException $e) {
            $this->assertEquals(98765, $usuario->getCodigoBarras());
        }
        
        try {
            $usuario->setCodigoBarras(123456);
            $this->fail('Código de barras maior que o tamanho permitido');
        } catch (Application_Model_UsuarioException $e) {
            $this->assertEquals(98765, $usuario->getCodigoBarras());
        }
    }

    /* @var $usuario Application_Model_Usuario */
    public function testSaveUsuario() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setCodigoBarras(66666);
        $usuario->setCurso("Engenharia de Software");
        $usuario->setEmail("thiagockrug@gmail.com");
        $usuario->setImpresso(true);
        $usuario->setInstituicao("Unipampa");
        $usuario->setNome("Thiago Cassio Krug");
        $usuario->setPagamento(Application_Model_Usuario::PAGO);
        $usuario->setRg("3093746001");
        $usuario->setIdTipoUsuario(1);
        $id = $usuario->save();
        $this->assertNotNull($id);
    }
    
    public function testGetSessoes() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setCodigoBarras(29347);
        $usuario->setIdTipoUsuario(1);
        $idUsuario = $usuario->save();
        $usuario->setId($idUsuario);
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao = $sessaoDAO->createRow();
        $sessao->setIdUsuario($idUsuario);
        $sessao->setIdPalestra($idPalestra);
        $sessao->save();
        
        $sessao = $sessaoDAO->createRow();
        $sessao->setIdUsuario($idUsuario);
        $sessao->setIdPalestra($idPalestra);
        $sessao->save();
        
        $sessoes = $usuario->getSessoes();
        $count = count($sessoes);
        
        //$this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $sessoes);
        $this->assertEquals(2, $count);
    }
    
    /*@var $usuario Application_Model_Usuario*/
    public function testEnviarEmailConfirmacao() {
        Sistema_Test_Mail::clearMailFiles();
        
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setNome("Afonso Barbosa");
        $usuario->setEmail("thiagockrug@gmail.com");
        $codigoBarras = new Application_Model_CodigoBarra();
        $usuario->setCodigoBarras($codigoBarras->gerarCodigoBarras());
        $usuario->setIdTipoUsuario(1);
        $id = $usuario->save();
        $usuario->enviarEmailConfirmacao();
        
        $email = new Application_Model_DbTable_EmailPendente();
        $emails = $email->getEmailsOfUsuario($id);
        $usuario2 = $usuarioDAO->getUsuarioById($id);
        
        $this->assertNotNull($emails);
        $this->assertEquals(0, $emails->count());
        $this->assertEquals($id, $usuario2->getId());
        //$this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $emails);
    }
    
    /*@var $usuario Application_Model_Usuario*/
    public function testEnviarEmailConfirmacaoEmailPendente() {
        Sistema_Test_Mail::clearMailFiles();
        
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setNome("Idelfonso Barbosa");
        $codigoBarras = new Application_Model_CodigoBarra();
        $usuario->setCodigoBarras($codigoBarras->gerarCodigoBarras());
        $usuario->setIdTipoUsuario(1);
        $id = $usuario->save();
        
        $transport = new Zend_Mail_Transport_Smtp();
        $usuario->enviarEmailConfirmacao($transport);
        
        $email = new Application_Model_DbTable_EmailPendente();
        $emails = $email->getEmailsOfUsuario($id);
        $usuario2 = $usuarioDAO->getUsuarioById($id);
        
        $this->assertNotNull($emails);
        $this->assertEquals(1, $emails->count());
        $this->assertEquals($id, $usuario2->getId());
        //$this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $emails);
    }
    
    protected function tearDown() {
        Sistema_Test_Mail::clearMailFiles();
        parent::tearDown();
    }
    
    public function testCriaObjeto() {
        $usuario = new Application_Model_Usuario();
        //$this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $usuario);
        //$this->assertInstanceOf('Application_Model_Usuario', $usuario);
    }
    
    public function testGetIdTipoUsuario() {
        $usuarioDbTable = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDbTable->createRow();
        $usuario->setIdTipoUsuario(1);
        $tipoUsuario = $usuario->getTipoUsuario();
        //$this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $tipoUsuario);
        //$this->assertInstanceOf('Application_Model_TipoUsuario', $tipoUsuario);
    }
    
    public function testGetPalestrasComPermissao() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setIdTipoUsuario(1);
        $usuario->setCodigoBarras(86321);
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
        //$this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $palestras);
        $this->assertEquals($num, $count);
    }

}