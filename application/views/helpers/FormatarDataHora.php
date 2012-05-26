<?php
class Zend_View_Helper_FormatarDataHora extends Zend_View_Helper_Abstract {

    public function FormatarDataHora($data)
    {
        if(!empty($data)){
        $date = new Zend_Date($data, Sistema_Data::DATABASE_DATETIME);
        $date = $date->get(Sistema_Data::REGULAR_DATETIME2);
        }else{
            $date = 'Não disponível';
        }
        
        return $date;

    }
}
