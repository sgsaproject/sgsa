<?php

class Zend_View_Helper_FormatarNome extends Zend_View_Helper_Abstract {

    public function FormatarNome($nome) {
//        $nome = mb_strtolower($nome, 'UTF-8');
//        $nome = ucwords($nome);
        
        $nome    = utf8_decode($nome);
        $nome    = strtolower($nome);
        $nome = ucwords($nome);
        $nome    = utf8_encode($nome);
        return $nome;
    }

}


?>
