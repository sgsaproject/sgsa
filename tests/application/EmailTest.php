<?php

/**
 * Description of EmailTest
 *
 * @author Rafael
 */
class EmailTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testCheckTransport() {
        $mail = new Zend_Mail();
        $this->assertTrue($mail->getDefaultTransport() instanceof Zend_Mail_Transport_File);
        $this->assertSame($mail->getDefaultFrom()['email'], 'sacta@sacta.com');
        $this->assertSame($mail->getDefaultReplyTo()['email'], 'sacta@sacta.com');
    }

    public function testSendMail() {
        Sistema_Test_Mail::clearMailFiles();
        $mail = new Zend_Mail('utf-8');
        $mail->addTo('recipient3@yahoo.com');
        $mail->addCc('recipient4@yahoo.com');
        $mail->setSubject('This is second test email');
        $mail->setBodyHtml('1st email');
        $mail->send();

        $fileMail = Sistema_Test_Mail::getEmails();
        $this->assertContains('sacta@sacta.com', $fileMail[0]->getHeader('from'));
        $this->assertContains('recipient3@yahoo.com', $fileMail[0]->getHeader('to'));
        $this->assertContains('recipient4@yahoo.com', $fileMail[0]->getHeader('cc'));
        $this->assertContains('This is second test email', $fileMail[0]->getHeader('subject'));
        $this->assertContains('1st email', $fileMail[0]->getContent());
    }

    protected function tearDown() {
        Sistema_Test_Mail::clearMailFiles();
        parent::tearDown();
    }

}