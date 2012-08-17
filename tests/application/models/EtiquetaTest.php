<?php

/**
 * Description of ReciboTest
 *
 * @author thiago
 */
class ReciboTest extends PHPUnit_Framework_TestCase {
    
    public function testA() {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->A(50, 150, 0, 4, 1, 1, N, 'NOME Do ouvinte Fica AQUI'); // A50,150,0,4,1,1,N,\"NOME DO ouvinte FICA AQUI\"
        $etiqueta->getTexto();
    }
    
}