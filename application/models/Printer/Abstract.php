<?php

/**
 * Description of Printer
 *
 * @author Rafael
 */
abstract class Application_Model_Printer_Abstract {

    protected $socket;
    protected $host;
    protected $port;
    protected $config;
    protected $texto;

    /**
     * Inicia o socket
     * @throws Exception
     */
    public function __construct() {
        if (($this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) == false) {
            throw new Exception("Could not create socket: " . socket_strerror(socket_last_error($this->socket)));
        }
        $this->texto = array();
        $this->config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        $this->host = $this->config->impressao->servidor->host;
        $this->port = $this->config->impressao->servidor->port;
    }

    /**
     * Realiza conexão socket com o servidor de impressão
     * @throws Exception
     * @return void 
     */
    public function conectar() {
        if ((socket_connect($this->socket, $this->host, $this->port)) === false) {
            throw new Exception("Could not bind to socket: " . socket_strerror(socket_last_error($this->socket)));
        }
    }

    /**
     * Adiciona um texto para impressão
     * @param string $texto
     * @return void
     */
    public function adicionarTexto($texto) {
        $this->texto[] = $texto;
    }

    abstract public function quebrarLinha();

    abstract public function imprimir();

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

    public function getTexto() {
        return $this->texto;
    }

    public function getTextoParaImpressao() {
        return implode('', $this->texto);
    }

}

