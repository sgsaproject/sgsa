<?php

class Zend_View_Helper_FormatarHora extends Zend_View_Helper_Abstract {

    public function FormatarHora($data) {
        if (!empty($data)) {
            $date = new Zend_Date($data);
            $dataFormatada = $date->get(Sistema_Data::ZEND_REGULAR_TIME_WITHOUT_SECONDS);
        } else {
            $dataFormatada = 'Não disponível';
        }

        return $dataFormatada;
    }

}
