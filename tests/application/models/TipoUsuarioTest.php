<?php
/**
 * Description of TipoUsuarioTest
 *
 * @author Rafael
 */
class TipoUsuarioTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testCriaObjeto(){
        $tipoUsuario = new Application_Model_TipoUsuario();
        $this->assertInstanceOf('Zend_Db_Table_Row_Abstract', $tipoUsuario);
        $this->assertInstanceOf('Application_Model_TipoUsuario', $tipoUsuario);
    }


}

