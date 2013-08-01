<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author Rafael
 */
class Sistema_Model_UtilsTest extends PHPUnit_Framework_TestCase {
    use \Sistema_Model_Utils;
    
    private $nomeCompleto;
    private $email;
    
    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }
    
    public function testSetAttributes(){
        $this->setAttributes(array('nome_completo'=>'john'));
        $this->assertSame('john', $this->nomeCompleto);
        $this->setAttributes(array('nomeCompleto'=>'maria'));
        $this->assertSame('maria', $this->nomeCompleto);
    }
    /**
     * @expectedException BadMethodCallException
     * @expectedExceptionMessage Call to undefined method
     */
    public function testSetAttributesNonExistingAttribute(){
        $this->setAttributes(array('nome_completoo'=>'john'));
    }
    
    public function testSetAttributesEmail(){
        $this->setAttributes(array('email'=>'joao@hotmail.com','nomeCompleto'=>'maria'));
        $this->assertSame('joao@hotmail.com', $this->email);
        $this->assertSame('maria', $this->nomeCompleto);
    } 
    
    private function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    private function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function testSetAttributesUsuario() {
        $dados = array('nome' => 'Thiago Cassio Krug',
            'rg' => '3093746001',
            'email' => 'thiagockrug@gmail.com',
            'curso' => 'Engenharia de Software',
            'instituicao' => 'Unipampa');
        
        $usuarioDAO = new Application_Model_DbTable_Usuario();
        $usuario = $usuarioDAO->createRow();
        $usuario->setAttributes($dados);
        
        $this->assertEquals($usuario->getNome(), $dados['nome']);
        $this->assertEquals($usuario->getRg(), $dados['rg']);
        $this->assertEquals($usuario->getEmail(), $dados['email']);
        $this->assertEquals($usuario->getCurso(), $dados['curso']);
        $this->assertEquals($usuario->getInstituicao(), $dados['instituicao']);
    }

}

