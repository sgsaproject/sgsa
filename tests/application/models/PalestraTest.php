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
        $this->fail("Revisar");
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
        $this->fail("Not implemented yet");
    }

}