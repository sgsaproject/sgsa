<?php

class OuvinteTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testIsImpresso() {
        $ouvinte = new Application_Model_Ouvinte();
        $ouvinte->setImpresso(1);
        $this->assertTrue($ouvinte->isImpresso());
    }
}