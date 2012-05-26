<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';

    protected $_dependentTables = array('Application_Model_DbTable_TipoUsuario');
    
    protected $_referenceMap = array(
        'TipoUsuario' => array(
            'refTableClass' => 'Application_Model_DbTable_Permissao',
            'columns' => array('id_usuario'),
            'refColumns' => 'id_usuario'
        )
    );
    
    public function getUsuarios(){
       $select = $this->select()->order('nome asc');
       return $this->fetchAll($select);
    }
    
    public function getUsuariosColaborador(){
       $select = $this->select()->where('id_tipo_usuario = 2')
               ->order('nome asc');
       return $this->fetchAll($select);
    }

}

