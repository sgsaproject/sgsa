<?php

/**
 * Description of Contato
 *
 * @author thiago
 */
class ContatoTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testSetAttributes() {
        $contato = new Application_Model_Contato();
        $contato->setAttributes(array('nome' => 'João Pedro Paulo',
            'email' => 'jpppp@mailcomum.com',
            'telefone' => '22331144',
            'mensagem' => 'O servidor não tah funcionando carai!',
            'assunto' => 'Pau no servidor'));

        $this->assertEquals($contato->getNome(), 'João Pedro Paulo');
        $this->assertEquals($contato->getEmail(), 'jpppp@mailcomum.com');
        $this->assertEquals($contato->getTelefone(), '22331144');
        $this->assertEquals($contato->getMensagem(), 'O servidor não tah funcionando carai!');
        $this->assertEquals($contato->getAssunto(), 'Pau no servidor');
    }

    public function testEnviarEmail() {
        Sistema_Test_Mail::clearMailFiles();

        $contato = new Application_Model_Contato();
        $contato->setAttributes(array('nome' => 'Thiago Cassio Krug Contato',
            'email' => 'thiagockrug@gmail.com',
            'telefone' => '96776131',
            'mensagem' => 'Teste unitário testEnviarEmail()',
            'assunto' => 'testEnviarEmail'));

        $contato->enviarEmail();

        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        $fileMail = Sistema_Test_Mail::getEmails();

        var_dump($fileMail[0]->getContent());
        $this->assertContains($contato->getEmail(), $fileMail[0]->getHeader('from'));
        $this->assertContains($contato->getEmail(), $fileMail[0]->getHeader('reply-to'));
        $this->assertContains($config->resources->mail->defaultfrom->email, $fileMail[0]->getHeader('to'));
        $this->assertContains($contato->getAssunto(), $fileMail[0]->getHeader('subject'));
        $this->assertNotNull($fileMail[0]->getContent());
        $this->assertGreaterThan(310, strlen($fileMail[0]->getContent())); //310 é o número de caracteres na página sem dados
    }

    protected function tearDown() {
        Sistema_Test_Mail::clearMailFiles();
        parent::tearDown();
    }

}
