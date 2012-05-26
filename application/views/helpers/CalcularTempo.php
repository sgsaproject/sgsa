<?php

class Zend_View_Helper_CalcularTempo extends Zend_View_Helper_Abstract {

    public function CalcularTempo($entrada, $saida) {
        $date = new Zend_Date($saida,  Sistema_Data::DATABASE_DATETIME);
        $date->subTime($entrada, Sistema_Data::DATABASE_DATETIME);
        return $date->get('HH:mm');
    }

}
