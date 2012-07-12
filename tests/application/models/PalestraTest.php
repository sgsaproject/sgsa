<?php

class PalestraTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testGetUsuariosComPermissao() {
        $palestraDAO = new Application_Model_DbTable_Palestra();
        $palestra = $palestraDAO->createRow();
        $idPalestra = $palestra->save();

        $num = 2;
        for ($i = 0; $i < $num; $i++) {
            $usuarioDAO = new Application_Model_DbTable_Usuario();
            $usuario = $usuarioDAO->createRow();
            $usuario->setId_tipo_usuario(1);
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

}