<?php

/**
 * Description of EmailTest
 *
 * @author Rafael
 */
class EmailTest extends PHPUnit_Framework_TestCase {
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testCheckTransport(){
        $mail = new Zend_Mail();
        $this->assertTrue($mail->getDefaultTransport() instanceof Zend_Mail_Transport_File);
        $this->assertSame($mail->getDefaultFrom()['email'], 'sactaunipampa@gmail.com');
        $this->assertSame($mail->getDefaultReplyTo()['email'], 'sactaunipampa@gmail.com');
    }
}
