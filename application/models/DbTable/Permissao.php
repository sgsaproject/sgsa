<?php

class Application_Model_DbTable_Permissao extends Zend_Db_Table_Abstract
{

    protected $_name = 'permissao';
    //protected $_dependentTables = array('Application_Model_DbTable_Usuario');
    
    protected $_referenceMap =  array(
        'PermissaoPalestra'  => array(
            'refTableClass'  => 'Application_Model_DbTable_Palestra',
            'columns'        => array('id_palestra'),
            'refColumns'     => 'id_palestra'
        ),
        'PermissaoUsuario'   => array(
            'refTableClass'  => 'Application_Model_DbTable_Usuario',
            'columns'        => array('id_usuario'),
            'refColumns'     => 'id_usuario'
        )
    );
    
    public function deletar($id_palestra, $id_usuario){
        $select = $this->select()->where('id_palestra = ?',$id_palestra)
                                ->where('id_usuario = ?',$id_usuario);
        $rows = $this->fetchAll($select);
        if(count($rows)>0){
            foreach($rows as $row){
                $row->delete();
            }
        }
    }
    
    public function temPermissao($id_palestra, $id_usuario){
        $select = $this->select()->where('id_palestra = ?',$id_palestra)
                                ->where('id_usuario = ?',$id_usuario);
        $row = $this->fetchRow($select);
        if(is_null($row)){
            return false;
        }else{
            return true;
        }
    }

    /*public function getPalestrasByUsuario(Application_Model_Usuario $usuario) {
        $this->getPalestrasByIdUsuario($usuario->getId_usuario());
    }
    
    public function getPalestrasByIdUsuario($usuario) {
        
    }*/
}

