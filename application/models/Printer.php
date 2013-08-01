<?php
/**
 * Description of Printer
 *
 * @author Rafael
 */
class Application_Model_Printer {
   
    /**
     * Retorna uma instancia de impressão de acordo com o valor da string
     * @param string $printer tipo de impressora
     * @return \Application_Model_Printer_Recibo|\Application_Model_Printer_Etiqueta
     * @throws Exception
     */
    public static function factory($printer){
        $printer = strtolower($printer);
        switch ($printer) {
            case "recibo":
                return new Application_Model_Printer_Recibo();
                break;
            case "etiqueta":
                return new Application_Model_Printer_Etiqueta();
                break;
            default:
                throw new Exception("Não há impressoras para o tipo informado");
                break;
        }
    }
    
}


