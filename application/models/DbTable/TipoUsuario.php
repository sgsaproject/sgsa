<?php

class Application_Model_DbTable_TipoUsuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'tipo_usuario';
    
    protected $_rowClass = 'Application_Model_TipoUsuario';

    protected $_referenceMap = array(
        'TipoUsuario' => array(
            'refTableClass' => 'Application_Model_DbTable_Usuario',
            'columns' => array('id_tipo_usuario'),
            'refColumns' => 'id_tipo_usuario'
        )
    );
    
    public function getTipoUsuario(){
         $select = $this->select()->order('nome ASC');
         return $this->fetchAll($select);
    }
    
    public function getTipoUsuarioById($idTipoUsuario) {
        return $this->find($idTipoUsuario)->current();
    }

}

