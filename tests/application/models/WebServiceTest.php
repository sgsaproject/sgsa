<?php
/**
 * Description of WebServiceTest
 *
 * @author Rafael
 */
class WebServiceTest extends PHPUnit_Framework_TestCase {

    private $token;
    /*@var $webservice Aplication_Model_WebService*/
    private $webservice;
    
    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
        $this->webservice = new Application_Model_WebService();
    }
    
    public function testGetToken(){
        $this->token = $this->webservice->getToken('admin@admin.com', 'admin');
        $this->assertEquals(strlen($this->token), 10);
        
    }
    public function testGetUsuarios(){
        $this->getToken();
        $this->assertEquals(strlen($this->token), 10);
        $result = $this->webservice->getUsuarios($this->token);
        $this->assertTrue(is_array($result));
        $this->assertEquals($result[0]->nome, 'Administrador');
    }
    public function testGetPalestras(){
        $this->getToken();
        $result = $this->webservice->getPalestras($this->token);
        $this->assertTrue(is_array($result));
        $this->assertEquals(sizeof($result), 10);
    }
    
    private function getToken(){
        $this->token = $this->webservice->getToken('admin@admin.com', 'admin');
    }
}

