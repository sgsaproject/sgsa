<?php

class Zend_View_Helper_FormatarData extends Zend_View_Helper_Abstract {

    public function FormatarData($data) {
        if (!empty($data)) {
            $date = new Zend_Date($data, Sistema_Data::ZEND_DATABASE_DATE);
            $dataFormatada = $date->get(Sistema_Data::ZEND_REGULAR_DATE);
        } else {
            $dataFormatada = 'Não disponível';
        }

        return $dataFormatada;
    }

}
