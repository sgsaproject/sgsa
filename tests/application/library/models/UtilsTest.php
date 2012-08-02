<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author Rafael
 */
class Sistema_Model_UtilsTest extends PHPUnit_Framework_TestCase {
    use \Sistema_Model_Utils;
    
    private $nomeCompleto;
    
    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testSetAttributes(){
        $this->setAttributes(array('nome_completo'=>'john'));
        $this->assertSame('john', $this->nomeCompleto);
        $this->setAttributes(array('nomeCompleto'=>'maria'));
        $this->assertSame('maria', $this->nomeCompleto);
    }
    
    private function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    private function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }



}

