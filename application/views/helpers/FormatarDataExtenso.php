<?php

class Zend_View_Helper_FormatarDataExtenso extends Zend_View_Helper_Abstract {

    public function FormatarDataExtenso($data) {
        $locale = new Zend_Locale('pt_BR');
        $date = new Zend_Date($data, false, $locale);
        return $date->toString(" dd 'de' MMMM 'de' yyyy");
    }

}
