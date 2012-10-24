<?php

/**
 * Description of ReciboTest
 *
 * @author Rafael
 */
class ReciboTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Application_Model_Printer_Recibo 
     */
    private $impressao;

    public function setUp() {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        $this->impressao = new Application_Model_Printer_Recibo();
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

}