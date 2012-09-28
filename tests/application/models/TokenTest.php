<?php

/**
 * Description of TokenTest
 *
 * @author Rafael
 */
class TokenTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testGerarToken() {
        $tokenDbTable = new Application_Model_DbTable_Token();
        $token = $tokenDbTable->createRow();
        $this->assertEquals(10, strlen($token->gerarToken()));
    }

    public function testSalvarToken() {
        $tokenDbTable = new Application_Model_DbTable_Token();
        $token = $tokenDbTable->createRow();
        /* @var $token Application_Model_Token */
        $tokenString = 'G3HT433s5tA';
        $token->token = $tokenString;
        $token->save();
        $this->assertEquals($tokenDbTable->existeToken($tokenString), true);
    }

}

