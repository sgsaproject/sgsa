<?php
class Zend_View_Helper_FormatarDataHora extends Zend_View_Helper_Abstract {

    public function FormatarDataHora($data)
    {
        if(!empty($data)){
        $date = new Zend_Date($data, Sistema_Data::ZEND_DATABASE_DATETIME);
        $date = $date->get(Sistema_Data::ZEND_REGULAR_DATETIME_WITHOUT_SECONDS);
        }else{
            $date = 'Não disponível';
        }
        
        return $date;

    }
}
