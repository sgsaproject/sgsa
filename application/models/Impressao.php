<?php

/**
 * Description of Impressao
 *
 * @author Rafael
 */
class Application_Model_Impressao {

    private $socket;
    private $host;
    private $port;
    private $texto;
    private $maxCaracteresPorLinha;

    /**
     * Inicia o socket
     * @throws Exception
     */
    public function __construct() {
        if (($this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) == false) {
            throw new Exception("Could not create socket: " . socket_strerror(socket_last_error($this->socket)));
        }
        $this->texto = array();
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        $this->host = $config->impressao->servidor->host;
        $this->port = $config->impressao->servidor->port;
        $this->maxCaracteresPorLinha = $config->impressao->max_caracteres_por_linha;
    }

    /**
     * Realiza conexão socket com o servidor de impressão
     * @throws Exception
     * @return void 
     */
    public function conectar() {
        if ((socket_connect($this->socket, $this->host, $this->port)) == false) {
            throw new Exception("Could not bind to socket: " . socket_strerror(socket_last_error($this->socket)));
        }
        $this->enviarTexto('SGSA:PRINT'."\r\n");
    }

    /**
     * Adiciona um texto para impressão
     * @param string $texto
     * @return void
     */
    public function adicionarTexto($texto) {
        $this->texto[] = $texto;
    }

    /**
     * Realiza uma quebra de linha
     * @return void
     */
    public function quebrarLinha() {
        $this->texto[] = chr(13) . chr(10);
    }

    /**
     * Formata texto para negrito
     * @param string $texto
     * @return string texto formatado
     */
    public function negrito($texto) {
        return chr(27) . chr(69) . $texto . chr(27) . chr(70);
    }

    /**
     * Formata texto para italico
     * @param string $texto
     * @return string texto formatado
     */
    public function italico($texto) {
        return chr(27) . chr(52) . $texto . chr(27) . chr(53);
    }

    /**
     * Formata texto para expandido
     * @param string $texto
     * @return string texto formatado
     */
    public function expandido($texto) {
        return chr(27) . chr(87) . chr(1) . $texto . chr(27) . chr(87) . chr(48);
    }

    /**
     * Formata texto para condensado
     * @param string $texto
     * @return string texto formatado
     */
    public function condensado($texto) {
        return chr(15) . $texto . chr(18);
    }

    /**
     * Formata texto para expandido duplo
     * @param string $texto
     * @return string texto formatado
     */
    public function expandidoDuplo($texto) {
        return chr(27) . chr(100) . chr(1) . $texto . chr(27) . chr(100) . chr(48);
    }

    /**
     * Formata texto para expandido duplo 2
     * @param string $texto
     * @return string texto formatado
     */
    public function expandidoDuplo2($texto) {
        return chr(27) . chr(87) . chr(1) . chr(27) . chr(100) . chr(1)
                . $texto .
                chr(27) . chr(100) . chr(48) . chr(27) . chr(87) . chr(48);
    }

    /**
     * Centraliza um texto
     * @param string $texto
     * @return string texto centralizado
     */
    public function centralizar($texto) {
        $textLength = strlen($texto);
        $tamanhoEspaco = $this->getMaxCaracteresPorLinha() - $textLength;
        return str_repeat(chr(32), $tamanhoEspaco / 2) . $texto . str_repeat(chr(32), $tamanhoEspaco / 2);
    }

    /**
     * Manda texto para o servidor de impressão
     * @throws Exception
     * @return void
     */
    public function imprimir() {
        $output = $this->getTextoParaImpressao();
        $this->enviarTexto($output."\r\n");
        $this->texto = array();
    }

    /**
     * Desconecta do servidor de impressão
     * @return void
     */
    public function desconectar() {
        socket_close($this->socket);
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getMaxCaracteresPorLinha() {
        return $this->maxCaracteresPorLinha;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getTextoParaImpressao() {
        return implode('', $this->texto);
    }
    /**
     * Envia um texto para o servidor de impressão
     * @param string $texto
     * @throws Exception
     */
    private function enviarTexto($texto) {
        if (socket_write($this->socket, $texto, strlen($texto)) == false) {
            throw new Exception("Could not write output: " . socket_strerror(socket_last_error($this->socket)));
        }
    }

}

