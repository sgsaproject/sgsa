<?php

require_once 'tcpdf/tcpdf.php';

class Sistema_PDF_Creator extends TCPDF {
    
    public function __construct($string) {
        parent::__construct($string);
    }


}

?>
