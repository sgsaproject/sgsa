<?php

class ProgramacaoControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {
/*
    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testNenhumaPalestra() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Engenharia de Software");
        $palestra->setNomePalestrante("Cléo");
        $palestra->setInstituicao("Unipampa - Alegrete");
        $palestra->setHoraInicioPrevista("20/08/2012 18:00:00");
        $palestra->setHoraFimPrevista("20/08/2012 20:00:00");
        $palestra->setHoraInicio("20/08/2012 18:10:34");
        $palestra->setHoraFim("20/08/2012 20:13:03");
        $palestra->setSala(101);
        $palestra->save();
        
        $palestras = $palestraDAO->fetchAll();
        
        /*@var $palestra Application_Model_Palestra*/
        /*foreach ($palestras as $palestra) {
            $deleted = $palestra->delete();
            if ($deleted <= 0) {
                $this->fail("Palestra " . $palestra->getNomePalestra() . " não foi deletada");
            }
        }
        
        $params = array('action' => 'index', 'controller' => 'programacao', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertNotRedirect();
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryCount("tr", 1);
    }
    
    public function testVariasPalestras() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Scrum");
        $palestra->setNomePalestrante("Mike Cohn");
        $palestra->setInstituicao("Altavista");
        $palestra->setHoraInicioPrevista("02/08/2012 08:30:00");
        $palestra->setHoraFimPrevista("02/08/2012 10:30:00");
        $palestra->setHoraInicio("02/08/2012 08:29:50");
        $palestra->setHoraFim("02/08/2012 10:31:03");
        $palestra->setSala(101);
        $palestra->save();
        
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("TDD");
        $palestra->setNomePalestrante("Kent Beck");
        $palestra->setInstituicao("Abril Editora");
        $palestra->setHoraInicioPrevista("02/08/2012 10:40:00");
        $palestra->setHoraFimPrevista("02/08/2012 12:40:00");
        $palestra->setHoraInicio("02/08/2012 18:10:34");
        $palestra->setHoraFim("02/08/2012 20:13:03");
        $palestra->setSala(101);
        $palestra->save();
        
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Engenharia de Software");
        $palestra->setNomePalestrante("Cléo");
        $palestra->setInstituicao("Unipampa - Alegrete");
        $palestra->setHoraInicioPrevista("20/08/2012 18:00:00");
        $palestra->setHoraFimPrevista("20/08/2012 20:00:00");
        $palestra->setHoraInicio("20/08/2012 18:10:34");
        $palestra->setHoraFim("20/08/2012 20:13:03");
        $palestra->setSala(101);
        $palestra->save();
        
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Engenharia de Software");
        $palestra->setNomePalestrante("Cléo");
        $palestra->setInstituicao("Unipampa - Alegrete");
        $palestra->setHoraInicioPrevista("20/08/2012 18:00:00");
        $palestra->setHoraFimPrevista("20/08/2012 20:00:00");
        $palestra->setHoraInicio("20/08/2012 18:10:34");
        $palestra->setHoraFim("20/08/2012 20:13:03");
        $palestra->setSala(101);
        $palestra->save();
        
        $count = $palestraDAO->fetchAll()->count();
        
        $params = array('action' => 'index', 'controller' => 'programacao', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);

        // assertions
        $this->assertNotRedirect();
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryCount("tr", $count + 1);
    }
    */
}