<?php

class Zend_View_Helper_FormatarPagamento extends Zend_View_Helper_Abstract {

    public function FormatarPagamento($string) {
       
        switch ($string) {
            case 'naopago':
                return '<span style="color: red;font-weight:bold;">Não Pago</span>';
                break;
            case 'pago':
                return '<span style="color: green;">Pago</span>';
                break;
            case 'isento':
                return '<span style="color: blue;">Isento</span>';
                break;

            default:
                return 'Não Disponível';
                break;
        }

    }

}
