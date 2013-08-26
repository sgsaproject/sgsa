<?php

/**
 * Description of Etiqueta
 *
 * @author Rafael
 */
class Application_Model_Printer_Etiqueta extends Application_Model_Printer_Abstract {

    /**
     * Inicia o socket
     * @throws Exception
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Realiza conexão socket com o servidor de impressão
     * @throws Exception
     * @return void 
     */
    public function conectar() {
        parent::conectar();
        $this->enviarTexto('SGSA:PRINT:ETIQUETA');
    }

    /**
     * Manda texto para o servidor de impressão
     * @throws Exception
     * @return void
     */
    public function imprimir() {
        $output = $this->getTextoParaImpressao();
        $this->enviarTexto($output);
        $this->texto = array();
    }

    /**
     * Realiza uma quebra de linha
     * @return void
     */
    public function quebrarLinha() {
        $this->texto[] = '\n';
    }

    /**
     * Recebe um texto do servidor de impressão
     * @throws Exception
     * @return string o texto enviado pelo servidor de impressão
     */
    public function receberTexto() {
        $read = socket_read($this->socket, 5);
        if ($read === false) {
            throw new Exception("Could not read input: " . socket_strerror(socket_last_error($this->socket)));
        }
        return $read;
    }

    /**
     * Envia um texto para o servidor de impressão
     * @param string $texto
     * @throws Exception
     */
    public function enviarTexto($texto) {
        $texto = $texto . "\r\n";
        $length = strlen($texto);
        while (true) {
            $sent = socket_write($this->socket, $texto, $length);
            if ($sent === false) {
                throw new Exception("Could not write output: " . socket_strerror(socket_last_error($this->socket)));
            }
            if ($sent < $length) {
                $texto = substr($texto, $sent);
                $length -= $sent;
                print("Message truncated: Resending: $texto");
            } else {
                return true;
            }
        }
        return false;

//        if (socket_write($this->socket, $texto, strlen($texto)) === false) {
//            throw new Exception("Could not write output: " . socket_strerror(socket_last_error($this->socket)));
//        }
    }

    /**
     * <p>[Function]: Prints a text</p> <p>[Format]: ASCII</p> <p>[Syntax]:
     * <ul><li>Ap1, p2, p3, p4, p5, p6, p7, "DATA" </li> <li>Ap1, p2, p3, p4,
     * p5, p6, p7, "DATA" Cn </li> <li>Ap1, p2, p3, p4, p5, p6, p7, "DATA" Vn
     * </li> <li>Ap1, p2, p3, p4, p5, p6, p7, Cn </li> <li>Ap1, p2, p3, p4, p5,
     * p6, p7, Vn </li></ul></p> <p>[Parameter and data range]: <ul><li>p1: X
     * coordinate in dots </li> <li>p2: Y coordinate in dots</li> <li>p3: define
     * the print rotation, data range: 0~3 <ul><li>0: no rotation</li> <li>1:
     * 90º rotation</li> <li>2: 180º rotation</li> <li>3: 270º
     * rotation</li></ul></li> <li>p4: ID number for fonts selection, data
     * range: 1~5, A~Z <ul><li>1~5: Internal font (Obs.: 5 only prints upper
     * case chars)</li> <li>A~Z: soft font, download soft font into RAM and
     * FLASH using ES command</li></ul></li> <li>p5: Magnify 1~8 times in
     * horizontal direction</li> <li>p6: Magnify 1~8 times in vertical
     * direction</li> <li>p7: Reverse or not <ul><li>N: unreverse</li> <li>R:
     * reverse</li></ul></li> <li>DATA: Print data</li> <li>Cn: Print cunters
     * values, please refer to the command C for details</li> <li>Vn: Print
     * variables, please refer to the command V for details</li> </ul></p>
     * <p>[Default value]: None</p> <p>[Notes]: The printer will no response,
     * when the user set the parameter out of the efective data range, for
     * instance, when the command grammar examination function implemented, if
     * p3 exceed the effective data range, the printer will give alarm.</p>
     * <p>[Examples]: The default position of origin point (0, 0) in the BPLB
     * coordinate is at the top left corner of the label, in the below example
     * print the data with font 1, 2, 3, 4, 5 and font 5 is reverse.
     * <ul><li>A50,30,0,1,1,1,N,\"This is font 1.\"\n"</li>
     * <li>A50,70,0,2,1,1,N,\"This is font 2.\"\n"</li>
     * <li>A50,110,0,3,1,1,N,\"This is font 3.\"\n"</li>
     * <li>A50,150,0,4,1,1,N,\"This is font 4.\"\n"</li>
     * <li>A50,200,0,5,1,1,R,\"FONT 5.\"\n"</li></ul></p> <p>[Relative]: Counter
     * value command Cn, variable command Vn, detailed information please refer
     * to description of this command.</p>
     *
     * @param type $p1 X coordinate in dots
     * @param type $p2 Y coordinate in dots
     * @param type $p3 define the print rotation, data range: 0~3 <ul><li>0: no
     * rotation</li> <li>1: 90º rotation</li> <li>2: 180º rotation</li> <li>3:
     * 270º rotation</li></ul>
     * @param type $p4 ID number for fonts selection, data range: 1~5, A~Z
     * <ul><li>1~5: Internal font (Obs.: 5 only prints upper case chars)</li>
     * <li>A~Z: soft font, download soft font into RAM and FLASH using ES
     * command</li></ul>
     * @param type $p5 Magnify 1~8 times in horizontal direction
     * @param type $p6 Magnify 1~8 times in vertical direction
     * @param type $p7 Reverse or not <ul><li>N: unreverse</li> <li>R:
     * reverse</li></ul>
     * @param type $data data to print
     */
    public function A($p1, $p2, $p3, $p4, $p5, $p6, $p7, $data) {
        parent::adicionarTexto('A' . $p1 . ',' . $p2 . ',' . $p3 . ',' . $p4 . ',' . $p5 . ',' . $p6 . ',' . $p7 . ',"' . $data . '"\n');
        // exemplo de como fica: "A50,150,0,4,1,1,N,\"NOME DO usuario FICA AQUI\"\n"
    }

    /**
     * <p>[Function]: print the 1D barcode</p> <p>[Format]: ASCII</p>
     * <p>[Syntax]: <ul><li>Bp1, p2, p3, p4, p5, p6, p7, p8, "DATA"</li>
     * <li>Bp1, p2, p3, p4, p5, p6, p7, p8, "DATA" Cn</li> <li>Bp1, p2, p3, p4,
     * p5, p6, p7, p8, "DATA" Vn</li> <li>Bp1, p2, p3, p4, p5, p6, p7, p8,
     * Cn</li> <li>Bp1, p2, p3, p4, p5, p6, p7, p8, Vn</li></ul></p>
     * <p>[Parameter and data range]: <ul><li>p1: X coordinate in dots</li>
     * <li>p2: Y coordinate in dots</li> <li>p3: define the print rotation, data
     * range: 0~3 <ul><li>0: no rotation</li> <li>1: 90º rotation</li> <li>2:
     * 180º rotation</li> <li>3: 270º rotation</li></ul></li> <li>p4: select
     * barcode <ul><li>0: print code128 UCC with 19 digitals</li> <li>1:
     * code128, program automatically</li> <li>1E: code UCC/EAN</li> <li>2:
     * cross barcode 25</li> <li>2C: cross barcode 25 with human readeable check
     * digit. Interpretation font doesn't print check digit</li> <li>2D: cross
     * barcode 25 with human readeable check digit. Interpretation font doesn't
     * print check digit</li> <li>2G: germany post code. Don't support
     * currently</li> <li>2M: code matrix 25. Don't support currently</li>
     * <li>2U: UPC cross barcode 25</li> <li>3: code 39</li> <li>3C: code 39
     * with checkout</li> <li>9: code 93</li> <li>E30: EAN13</li> <li>E32: EAN13
     * with 2-digital function code</li> <li>E35: EAN13 with 5-digital function
     * code</li> <li>E80: EAN8</li> <li>E82: EAN8 with 2-digital function
     * code</li> <li>E85: EAN8 with 5-digital function code</li> <li>K:
     * codabar</li> <li>P: postnet</li> <li>UA0: UPC-A</li> <li>UA2: UPC-A with
     * 2-digital function code</li> <li>UA5: UPC-A with 5-digital function
     * code</li> <li>UE0: UPC-E</li> <li>UE2: UPC-E with 2-digital function
     * code</li> <li>UE5: UPC-E with 5-digital function code</li></ul></li>
     * <li>p5/p6: the proportion between the narrow and wide bar width.</li>
     * <li>p7: barcode height</li> <li>p8: <ul><li>N: do not print the barcode
     * interpretation font</li> <li>B: print the barcode interpretation
     * font</li></ul></li> <li>DATA: a text string</li> <li>Cn: a counter value,
     * please refer to the command C.</li> <li>Vn: a variable string, please
     * refer to the command V.</li></ul></p> <p>[Default value]: No</p>
     * <p>[Notes]: The printer won't respond, when the parameter is out of
     * effective range, for instance, when the user configures the value of
     * rotation (p3) to be 3, the printer will print the barcode and
     * interpretation in sequence.</p> <p>[Examples]:
     * <ul><li>B20,20,0,E80,3,3,41,B,\"0123459\"\n</li>
     * <li>B20,120,0,K,3,5,61,B,\"A0B1C2D3\"\n</li>
     * <li>B190,300,2,1,2,2,51,B,\"0123456789\"\n</li>
     * <li>B20,330,0,UA0,2,2,41,B,\"13579024680\"\n</li></ul></p> <p>[Relative]:
     * Please refer to following command about Cn and Vn</p>
     *
     * @param type $p1 X coordinate in dots
     * @param type $p2 Y coordinate in dots
     * @param type $p3 define the print rotation, data range: 0~3 <ul><li>0: no
     * rotation</li> <li>1: 90º rotation</li> <li>2: 180º rotation</li> <li>3:
     * 270º rotation</li></ul>
     * @param type $p4 select barcode <ul><li>0: print code128 UCC with 19
     * digitals</li> <li>1: code128, program automatically</li> <li>1E: code
     * UCC/EAN</li> <li>2: cross barcode 25</li> <li>2C: cross barcode 25 with
     * human readeable check digit. Interpretation font doesn't print check
     * digit</li> <li>2D: cross barcode 25 with human readeable check digit.
     * Interpretation font doesn't print check digit</li> <li>2G: germany post
     * code. Don't support currently</li> <li>2M: code matrix 25. Don't support
     * currently</li> <li>2U: UPC cross barcode 25</li> <li>3: code 39</li>
     * <li>3C: code 39 with checkout</li> <li>9: code 93</li> <li>E30:
     * EAN13</li> <li>E32: EAN13 with 2-digital function code</li> <li>E35:
     * EAN13 with 5-digital function code</li> <li>E80: EAN8</li> <li>E82: EAN8
     * with 2-digital function code</li> <li>E85: EAN8 with 5-digital function
     * code</li> <li>K: codabar</li> <li>P: postnet</li> <li>UA0: UPC-A</li>
     * <li>UA2: UPC-A with 2-digital function code</li> <li>UA5: UPC-A with
     * 5-digital function code</li> <li>UE0: UPC-E</li> <li>UE2: UPC-E with
     * 2-digital function code</li> <li>UE5: UPC-E with 5-digital function
     * code</li></ul>
     * @param type $p5 p5/p6: the proportion between the narrow and wide bar width.
     * @param type $p6 p5/p6: the proportion between the narrow and wide bar width.
     * @param type $p7 barcode height
     * @param type $p8 <ul><li>N: do not print the barcode interpretation font</li>
     * <li>B: print the barcode interpretation font</li></ul>
     * @param type $data a text string
     */
    public function B($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $data) {
        parent::adicionarTexto('B' . $p1 . ',' . $p2 . ',' . $p3 . ',' . $p4 . ',' . $p5 . ',' . $p6 . ',' . $p7 . ',' . $p8 . ',"' . $data . '"\n');
        // exemplo "B100,450,0,3,5,11,50,B,\"12345\"\n" // 5:11 eh o tamanho ideal, naum mude
    }

    /**
     * <p>[Function]: Print label</p>
     * <p>[Format]: ASCII</p>
     * <p>[Syntax]: Pp1, p2</p>
     * <p>[Parameter and data range]:
     * <ul><li>p1: number of label</li>
     * <li>p2: number of copies per label</li></ul></p>
     * <p>[Default value]: None</p>
     * <p>[Notes]: None</p>
     * <p>[Relative]: None</p>
     * 
     * @param type $p1 number of label
     * @param type $p2 number of copies per label
     */
    public function P($p1, $p2) {
        parent::adicionarTexto('P' . $p1 . ',' . $p2 . '\n');
    }

    public function P1($p1) {
        parent::adicionarTexto('P' . $p1 . '\n');
    }

    /**
     * <p>[Function]: Set print location compared to origin point</p>
     * <p>[Format]: ASCII</p>
     * <p>[Syntax]: Rp1, p2</p>
     * <p>[Parameter and data range]:
     * <ul><li>p1: horizontal distance to origin point</li>
     * <li>p2: vertical distance to origin point</li></ul></p>
     * <p>[Default value]: None</p>
     * <p>[Notes]: None</p>
     * <p>[Example]: None</p>
     * <p>[Relative]: None</p>
     * 
     * @param type $p1 horizontal distance to origin point
     * @param type $p2 vertical distance to origin point
     */
    public function R($p1, $p2) {
        parent::adicionarTexto('R' . $p1 . ',' . $p2 . '\n');
    }

    /**
     * <p>[Function]: Clear buffer</p>
     * <p>[Format]: ASCII</p>
     * <p>[Syntax]: None</p>
     * <p>[Parameter and data range]: None</p>
     * <p>[Default value]: None</p>
     * <p>[Notes]: None</p>
     * <p>[Example]: None</p>
     * <p>[Relative]: None</p>
     */
    public function N() {
        parent::adicionarTexto('N\n');
    }

    /**
     * <p>[Function]: Set print direction</p>
     * <p>[Format]: ASCII</p>
     * <p>[Syntax]: Zp1</p>
     * <p>[Parameter and data range]:
     * <ul><li>p1: direction. Acceptable values are B and T. The default value is T.
     * <ul><li>B: print start from right bottom of label</li>
     * <li>T: print start from left top of label</li></ul>
     * </li></ul></p>
     * <p>[Default value]: None</p>
     * <p>[Notes]: None</p>
     * <p>[Example]: None</p>
     * <p>[Relative]: None</p>
     * 
     * @param type $p1
     */
    public function Z($p1) {
        parent::adicionarTexto('Z' . $p1 . '\n');
    }

    /**
     * <p>[Function]: Set paper height and paper type</p>
     * <p>[Format]: ASCII</p>
     * <p>[Syntax]: Qp1, p2</p>
     * <p>[Parameter and data range]: If p1 and p2 don't equal zero, then p1 is 
     * the label height in dots. If p2 equals zero, p1 is paper out distance 
     * after printing p2 the height of gap/black lines/holes between labels. 
     * If p2 equals zero, paper type is continuous.</p>
     * <p>[Default value]: None</p>
     * <p>[Notes]: None</p>
     * <p>[Example]: None</p>
     * <p>[Relative]: None</p>
     * 
     * @param type $p1
     * @param type $p2
     */
    public function Q($p1, $p2) {
        parent::adicionarTexto('Q' . $p1 . ',' . $p2 . '\n');
    }

}

