<?php

/**
 * Description of EtiquetaTest
 *
 * @author thiago
 */
class EtiquetaTest extends PHPUnit_Framework_TestCase {
    
    public function testConectarImprimirDesconectar() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->conectar();
        $etiqueta->R(0, 0);
        $etiqueta->N();
        $etiqueta->Z('B');
        $etiqueta->Q(122, 16);
        $etiqueta->A(50, 150, 0, 4, 1, 1, 'N', 'NOME Do ouvinte Fica AQUI');
        $etiqueta->B(100, 450, 0, 3, 5, 11, 50, 'B', '12345');
        $etiqueta->P1(1);
        
        $this->assertEquals('R0,0\n', $etiqueta->getTexto()[0]);
        $this->assertEquals('N\n', $etiqueta->getTexto()[1]);
        $this->assertEquals('ZB\n', $etiqueta->getTexto()[2]);
        $this->assertEquals('Q122,16\n', $etiqueta->getTexto()[3]);
        $this->assertEquals('A50,150,0,4,1,1,N,"NOME Do ouvinte Fica AQUI"\n', $etiqueta->getTexto()[4]);
        $this->assertEquals('B100,450,0,3,5,11,50,B,"12345"\n', $etiqueta->getTexto()[5]);
        $this->assertEquals('P1\n', $etiqueta->getTexto()[6]);
        
        $etiqueta->imprimir();
        $etiqueta->desconectar();
    }
    
    public function testA() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->A(50, 150, 0, 4, 1, 1, 'N', 'NOME Do ouvinte Fica AQUI'); // A50,150,0,4,1,1,N,\"NOME DO ouvinte FICA AQUI\"
        
        $this->assertEquals('A50,150,0,4,1,1,N,"NOME Do ouvinte Fica AQUI"\n', $etiqueta->getTexto()[0]);
    }
    
    public function testB() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->B(100, 450, 0, 3, 5, 11, 50, 'B', '12345'); // B100,450,0,3,5,11,50,B,"12345"\n
        
        $this->assertEquals('B100,450,0,3,5,11,50,B,"12345"\n', $etiqueta->getTexto()[0]);
    }
    
    public function testP1() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->P1(1);
        
        $this->assertEquals('P1\n', $etiqueta->getTexto()[0]);
    }
    
    public function testR() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->R(0, 0);
        
        $this->assertEquals('R0,0\n', $etiqueta->getTexto()[0]);
    }
    
    public function testN() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->N();
        
        $this->assertEquals('N\n', $etiqueta->getTexto()[0]);
    }
    
    public function testZ() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->Z('B');
        
        $this->assertEquals('ZB\n', $etiqueta->getTexto()[0]);
    }
    
    public function testQ() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->Q(122, 16);
        
        $this->assertEquals('Q122,16\n', $etiqueta->getTexto()[0]);
    }
    
}