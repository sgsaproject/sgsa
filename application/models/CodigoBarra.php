<?php

class Application_Model_CodigoBarra {

    public function existeCodigoBarras($codigo) {
        $select = $this->select()->where('codigo_barras = ?', $codigo);
        $row = $this->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function gerarCodigoBarras() {
        do {
            //gera o numero de codigo de barras do ouvinte
            $codigoBarras = '';
            $numeros = range(0, 9);
            for ($index = 0; $index < 5; $index++) {
                $codigoBarras .= $numeros[rand(0, 9)];
            }
        } while ($this->existeCodigoBarras($codigoBarras));
        return $codigoBarras;
    }

}

