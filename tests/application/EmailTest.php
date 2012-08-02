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
        $this->assertSame($mail->getDefaultFrom()['email'], 'sactaunipampa@gmail.com');
        $this->assertSame($mail->getDefaultReplyTo()['email'], 'sactaunipampa@gmail.com');
    }

    public function testSendMail() {
        $this->clearMailFiles();
        $mail = new Zend_Mail('utf-8');
        $mail->addTo('recipient3@yahoo.com');
        $mail->addCc('recipient4@yahoo.com');
        $mail->setSubject('This is second test email');
        $mail->setBodyHtml('1st email');
        $mail->send();
        
        $fileMail = $this->getEmails();
        $this->assertContains('sactaunipampa@gmail.com', $fileMail[0]->getHeader('from'));
        $this->assertContains('recipient3@yahoo.com', $fileMail[0]->getHeader('to'));
        $this->assertContains('recipient4@yahoo.com', $fileMail[0]->getHeader('cc'));
        $this->assertContains('This is second test email', $fileMail[0]->getHeader('subject'));
        $this->assertContains('1st email', $fileMail[0]->getContent());

    }

    private function getEmails() {
        $directory = APPLICATION_PATH. "/../data/cache/sentmail";
        //remove the pesky .. and .
        $files = array_diff(scandir($directory), array('..', '.'));
        sort($files);  //IMPORTANT - We need them in order!
        $emails = array();
        foreach ($files as $file) {
            if ($file !=='gitkeep') {
                $email_str = realpath(APPLICATION_PATH . "/../data/cache/sentmail/" . $file);
                $emails[] = new Zend_Mail_Message_File(array('file' => $email_str));
            }
        }
        return $emails;
    }

    private static function clearMailFiles() {
        //delete all files in folder
        $directory = APPLICATION_PATH ."/../data/cache/sentmail";
        $files1 = array_diff(scandir($directory), array('..', '.'));
        foreach ($files1 as $val) {
            if ($val !== 'gitkeep') {
                unlink(realpath($directory . "/" . $val));
            }
        }
    }
    
    protected function tearDown()
    {
        self::clearMailFiles();
        parent::tearDown();
    }


}
