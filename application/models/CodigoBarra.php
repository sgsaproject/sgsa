<?php

class Application_Model_CodigoBarra {

    public function existeCodigoBarras($codigo) {
        $usuarioDbTable = new Application_Model_DbTable_Usuario();
        $select = $usuarioDbTable->select()->where('codigo_barras = ?', $codigo);
        $row = $usuarioDbTable->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function gerarCodigoBarras() {
        do {
            //gera o numero de codigo de barras do usuario
            $codigoBarras = '';
            $numeros = range(0, 9);
            for ($index = 0; $index < 5; $index++) {
                $codigoBarras .= $numeros[rand(0, 9)];
            }
        } while ($this->existeCodigoBarras($codigoBarras));
        return $codigoBarras;
    }

}

