<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImpressaoTest
 *
 * @author Rafael
 */
class ImpressaoTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Application_Model_Impressao 
     */
    private $impressao;

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        $this->impressao = new Application_Model_Impressao();
        parent::setUp();
    }

    public function testImpressaoInfo() {
        $this->assertEquals($this->impressao->getHost(), $this->bootstrap->getOptions()['impressao']['servidor']['host']);
        $this->assertEquals($this->impressao->getPort(), $this->bootstrap->getOptions()['impressao']['servidor']['port']);
        $this->assertEquals($this->impressao->getMaxCaracteresPorLinha(), $this->bootstrap->getOptions()['impressao']['max_caracteres_por_linha']);
    }

    public function testImpressaoCentralizar() {
        $text = strlen($this->impressao->centralizar('SACTA!'));
        $this->assertEquals($this->impressao->getMaxCaracteresPorLinha(), $text);
    }

    public function testImpressao() {
        $this->impressao->contectar();
        $this->impressao->adicionarTexto($this->impressao->centralizar('SACTA!'));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto('Isso é um teste');
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->negrito('Texto em negrito'));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->italico('Texto em italico'));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->negrito($this->impressao->italico('Texto em negrito e italico')));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->condensado('Texto condensado'));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->expandido('Texto expandido'));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->expandidoDuplo('Texto expandido duplo'));
        $this->impressao->quebrarLinha();
        $this->impressao->adicionarTexto($this->impressao->expandidoDuplo2('Texto expandido duplo 2'));
       
        
        $this->assertEquals($this->impressao->getTexto()[0], str_repeat(chr(32), 15) . 'SACTA!' . str_repeat(chr(32), 15));
        $this->assertEquals($this->impressao->getTexto()[1], chr(13) . chr(10));
        $this->assertEquals($this->impressao->getTexto()[2], 'Isso é um teste');
//        $this->assertEquals($this->impressao->getTextoParaImpressao(), str_repeat(chr(32), 15) . 'SACTA!' . str_repeat(chr(32), 15) .
//                chr(13) . chr(10) .
//                'Isso é um teste');
        $this->assertEquals(strlen(str_repeat(chr(32), 15) . 'SACTA!' . str_repeat(chr(32), 15)), 36);
        $this->assertEquals(strlen(chr(13) . chr(10)), 2);
        //$this->assertEquals(strlen('Isso é um teste'), 15);
        //$this->assertEquals(strlen($this->impressao->getTextoParaImpressao()), 36 + 2 + 15);
        $this->impressao->imprimir();
    }

}

