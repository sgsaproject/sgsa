<?php

class Application_Model_Usuario extends Zend_Db_Table_Row_Abstract {
    
    private $tipoUsuario;
    private $palestras;

    public function getId() {
        return $this->id_usuario;
    }
    
    public function setId($idUsuario) {
        $this->id_usuario = $idUsuario;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }
    
    public function getIdTipoUsuario() {
        return $this->id_tipo_usuario;
    }
    
    public function setIdTipoUsuario($idTipoUsuario) {
        $this->id_tipo_usuario = $idTipoUsuario;
    }
    
    public function getTipoUsuario() {
        if (is_null($this->tipoUsuario)) {
            $tipoUsuarioDAO = new Application_Model_DbTable_TipoUsuario();
            $this->tipoUsuario = $tipoUsuarioDAO->getTipoUsuarioById($this->id_tipo_usuario);
        }
        return $this->tipoUsuario;
    }
    
    public function setTipoUsuario(Application_Model_TipoUsuario $tipoUsuario) {
        $this->tipoUsuario = $tipoUsuario;
        $this->id_tipo_usuario = $tipoUsuario->getId_tipo_usuario();
    }
    
    public function getPalestrasComPermissao() {
        if (is_null($this->palestras)) {
            $this->palestras = $this->findManyToManyRowset('Application_Model_DbTable_Palestra',
                    'Application_Model_DbTable_Permissao');
        }
        return $this->palestras;
    }

}
