<?php

class Application_Model_TipoUsuario extends Zend_Db_Table_Row_Abstract
{
    public function getId_tipo_usuario() {
        return $this->id_tipo_usuario;
    }
    
    public function setId_tipo_usuario($idTipoUsuario) {
        $this->id_tipo_usuario = $idTipoUsuario;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getAlias() {
        return $this->alias;
    }
    
    public function setAlias($alias) {
        $this->alias = $alias;
    }
}

