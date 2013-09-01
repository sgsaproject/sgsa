<?php

class Zend_View_Helper_FormatarPagamento extends Zend_View_Helper_Abstract {

    public function FormatarPagamento($string) {
       
        switch ($string) {
            case Application_Model_Usuario::NAO_PAGO:
                return '<span style="color: red;font-weight:bold;">Não Pago</span>';
                break;
            case Application_Model_Usuario::PAGO:
                return '<span style="color: green;">Pago</span>';
                break;
            case Application_Model_Usuario::ISENTO:
                return '<span style="color: blue;">Isento</span>';
                break;

            default:
                return 'Não Disponível';
                break;
        }

    }

}
