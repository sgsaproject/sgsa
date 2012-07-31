<?php

class PalestraTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testCriaObjeto() {
        $palestra = new Application_Model_Palestra();
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $palestra);
        $this->assertInstanceOf('Application_Model_Palestra', $palestra);
    }
    
    public function testSaveObject() {
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
        $id = $palestra->save();
        
        $palestra2 = $palestraDAO->getPalestraById($id);
        
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $palestra2);
        $this->assertInstanceOf('Application_Model_Palestra', $palestra2);
        
        $this->assertEquals($palestra->getNomePalestra(), $palestra2->getNomePalestra());
        $this->assertEquals($palestra->getNomePalestrante(), $palestra2->getNomePalestrante());
        $this->assertEquals($palestra->getInstituicao(), $palestra2->getInstituicao());
        $this->assertEquals($palestra->getHoraInicioPrevista(), $palestra2->getHoraInicioPrevista());
        $this->assertEquals($palestra->getHoraFimPrevista(), $palestra2->getHoraFimPrevista());
        $this->assertEquals($palestra->getHoraInicio(), $palestra2->getHoraInicio());
        $this->assertEquals($palestra->getHoraFim(), $palestra2->getHoraFim());
        $this->assertEquals($palestra->getSala(), $palestra2->getSala());
    }
    
    public function testGetHoraInicioPrevista() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraInicioPrevista("01/02/2012 20:00:00");
        $this->assertEquals("01/02/2012 20:00:00", $palestra->getHoraInicioPrevista());
    }
    
    public function testSetHoraInicioPrevista() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraInicioPrevista("01/02/2012 20:00:00");
        $this->assertEquals("2012-02-01 20:00:00", $palestra->hora_inicio_prevista);
    }
    
    public function testGetHoraFimPrevista() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraFimPrevista("01/02/2012 20:00:00");
        $this->assertEquals("01/02/2012 20:00:00", $palestra->getHoraFimPrevista());
    }
    
    public function testSetHoraFimPrevista() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraFimPrevista("01/02/2012 20:00:00");
        $this->assertEquals("2012-02-01 20:00:00", $palestra->hora_fim_prevista);
    }
    
    public function testGetHoraInicio() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraInicio("01/02/2012 20:00:00");
        $this->assertEquals("01/02/2012 20:00:00", $palestra->getHoraInicio());
    }
    
    public function testSetHoraInicio() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraInicio("01/02/2012 20:00:00");
        $this->assertEquals("2012-02-01 20:00:00", $palestra->hora_inicio);
    }
    
    public function testGetHoraFim() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraFim("01/02/2012 20:00:00");
        $this->assertEquals("01/02/2012 20:00:00", $palestra->getHoraFim());
    }
    
    public function testSetHoraFim() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setHoraFim("01/02/2012 20:00:00");
        $this->assertEquals("2012-02-01 20:00:00", $palestra->hora_fim);
    }

    public function testGetUsuariosComPermissao() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();

        $num = 2;
        for ($i = 0; $i < $num; $i++) {
            $usuarioDAO = new Application_Model_DbTable_Usuario();
            $usuario = $usuarioDAO->createRow();
            $usuario->setIdTipoUsuario(1);
            $idUsuario = $usuario->save();

            $permissao = new Application_Model_DbTable_Permissao();
            $data['id_usuario'] = $idUsuario;
            $data['id_palestra'] = $idPalestra;
            $permissao->insert($data);
        }

        $usuarios = $palestra->getUsuariosComPermissao();
        $count = count($usuarios);
        $this->assertInstanceOf('Zend_Db_Table_Rowset_Abstract', $usuarios);
        $this->assertEquals($num, $count);
    }
    
    public function testGetSessoes() {
        $ouvinteDAO = new Application_Model_DbTable_Ouvinte();
        $ouvinte = $ouvinteDAO->createRow();
        $ouvinte->setNome("Catanduva Moreira");
        $ouvinte->setCodigoBarras(31246);
        $ouvinte->save();
        
        $ouvinte2 = $ouvinteDAO->createRow();
        $ouvinte2->setNome("Perneta da Tijuca");
        $ouvinte2->setCodigoBarras(23451);
        $ouvinte2->save();
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $palestra->setNomePalestra("Scrum");
        $palestra->save();
        
        $sessaoDAO = new Application_Model_DbTable_Sessao();
        $sessao1 = $sessaoDAO->createRow();
        $sessao1->setOuvinte($ouvinte);
        $sessao1->setPalestra($palestra);
        $sessao1->setHoraEntrada("30/07/2012 08:01:52");
        $sessao1->setHoraSaida("30/07/2012 09:56:31");
        $idSessao1 = $sessao1->save();
        
        $sessao2 = $sessaoDAO->createRow();
        $sessao2->setOuvinte($ouvinte2);
        $sessao2->setPalestra($palestra);
        $sessao2->setHoraEntrada("30/07/2012 08:02:01");
        $sessao2->setHoraSaida("30/07/2012 09:56:40");
        $idSessao2 = $sessao2->save();
        
        $sessoes = $palestra->getSessoes();
        
        $this->assertInstanceOf('Zend_Db_Table_Rowset', $sessoes);
        
        var_dump($sessao1->getPalestra());
        
        foreach ($sessoes as $sessao) {
            if ($sessao->getId() == $idSessao1) {
                $this->assertEquals($sessao1->getOuvinte(), $sessao->getOuvinte());
                $this->assertEquals($sessao1->getPalestra(), $sessao->getPalestra());
                $this->assertEquals($sessao1->getHoraEntrada(), $sessao->getHoraEntrada());
                $this->assertEquals($sessao1->getHoraSaida(), $sessao->getHoraSaida());
                $this->assertEquals($sessao1, $sessao);
            } else if ($sessao->getId() == $idSessao2) {
                $this->assertEquals($sessao2->getOuvinte(), $sessao->getOuvinte());
                $this->assertEquals($sessao2->getPalestra(), $sessao->getPalestra());
                $this->assertEquals($sessao2->getHoraEntrada(), $sessao->getHoraEntrada());
                $this->assertEquals($sessao2->getHoraSaida(), $sessao->getHoraSaida());
                $this->assertEquals($sessao2, $sessao);
            } else {
                $this->fail("Mais sessões do que o esperado");
            }
        }
    }

}