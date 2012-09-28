<?php

/**
 * Description of Token
 *
 * @author Rafael
 */
class Application_Model_Token extends Zend_Db_Table_Row_Abstract {
    
    
    private $usuario;
    
    public function getTipoUsuario() {
        if (is_null($this->usuario)) {
            $tipoDAO = new Application_Model_DbTable_Usuario();
            $this->usuario = $tipoDAO->getUsuarioById($this->id_usuario);
        }
        return $this->usuario;
    }
    
    public function setUsuario(Application_Model_Usuario $usuario){
        $this->usuario = $usuario;
        $this->id_usuario = $usuario->getId();
    }
    
    public function getToken() {
        return $this->token;
    }

    public function gerarToken() {
        $tokenDbTable = new Application_Model_DbTable_Token();

        do {
            $this->token = $this->gerarValorAleatorio();
        } while ($tokenDbTable->existeToken($this->token) == true);

        return $this->token;
    }
    
    /**
     * Altera data de criação para atual se não informada a data
     * @param DATETIME $data
     * @return DATETIME 
     */
    public function setDataCriacao($data = null)
    {
        if (empty($data)) {
            $this->data_criacao = Zend_Date::now()->get(Sistema_Data::ZEND_DATABASE_DATETIME);
        } else {
            $this->data_criacao = $data;
        }
        return $this->data_criacao;
    }

    private function gerarValorAleatorio($size = 10, $numeric = true, $upperCase = true, $lowerCase = true) {
        $chars = array();
        if ($upperCase == true) {
            $chars = array_merge($chars, range('A', 'Z'));
        }
        if ($lowerCase == true) {
            $chars = array_merge($chars, range('a', 'z'));
        }
        if ($numeric == true) {
            $chars = array_merge($chars, range(0, 9));
        }
        shuffle($chars);
        $code = '';
        for ($index = 0; $index < $size; $index++) {
            $code .=$chars[$index];
        }
        return $code;
    }

}

