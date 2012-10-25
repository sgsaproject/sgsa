<?php

class InscricaoControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testInscricaoPage() {

        $params = array('action' => 'index', 'controller' => 'inscricao', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertNotRedirect();
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains("div#conteudo h2", "Inscrições");
    }

    public function testInscreverAction() {
        $params = array('action' => 'inscrever', 'controller' => 'inscricao', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);

        $this->request->setMethod('POST')
                ->setPost(array('nome' => 'Idelfina Souza', 'rg' => '63539631284',
                    'email' => 'eidelfinasouza@algummail.com', 'curso' => 'Farmácia',
                    'instituicao' => 'Unipampa'));

        $this->dispatch($url);

        // assertions
        $this->assertRedirectTo('/inscricao/sucesso');
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction('inscrever');
    }

    public function testSucessoAction() {
        $params = array('action' => 'sucesso', 'controller' => 'inscricao', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertNotRedirect();
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains("div#conteudo h2", "Inscrição");
    }

}