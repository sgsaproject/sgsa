<?php

class PermissaoTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    /* @var $usuario Application_Model_Usuario */
    public function testDeletar() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setCodigoBarras(74987);
        $usuario->setIdTipoUsuario(1);
        $idUsuario = $usuario->save();
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();
        
        $permissao = new Application_Model_DbTable_Permissao();
        $data['id_usuario'] = $idUsuario;
        $data['id_palestra'] = $idPalestra;
        $idPermissao = $permissao->insert($data);
        
        $permissao->deletar($idPalestra, $idUsuario);
        
        $permissaoDeletada = $permissao->find($idPermissao)->current();
        $this->assertNull($permissaoDeletada);
    }
    
    public function testTemPermissao() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setIdTipoUsuario(1);
        $usuario->setCodigoBarras(74917);
        $idUsuario = $usuario->save();
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();
        
        $permissao = new Application_Model_DbTable_Permissao();
        $data['id_usuario'] = $idUsuario;
        $data['id_palestra'] = $idPalestra;
        $permissao->insert($data);
        
        $condition = $permissao->temPermissao($idPalestra, $idUsuario);
        
        $this->assertTrue($condition);
    }
    
    public function testNaoTemPermissao() {
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setIdTipoUsuario(1);
        $usuario->setCodigoBarras(74981);
        $idUsuario = $usuario->save();
        
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();
        
        $permissao = new Application_Model_DbTable_Permissao();
        $data['id_usuario'] = $idUsuario;
        $data['id_palestra'] = $idPalestra;
        $permissao->insert($data);
        
        $condition = $permissao->temPermissao($idPalestra, -1);
        
        $this->assertFalse($condition);
    }
}