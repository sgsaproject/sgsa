<?php

class InscricaoControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testInscricaoPage() {
        $this->dispatch('/inscricao');
        $this->assertResponseCode(200);
        //$this->assertQueryContentContains('h1', 'Login');
        //$this->assertQuery('form#login'); // id of form
    }

}

