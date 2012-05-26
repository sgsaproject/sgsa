<?php

class Application_Model_DbTable_Ouvinte extends Zend_Db_Table_Abstract
{

    protected $_name = 'ouvinte';
    protected $_dependentTables = array('Application_Model_DbTable_Sessao');
    protected $_referenceMap = array(
        'TipoUsuario' => array(
            'refTableClass' => 'Application_Model_DbTable_Sessao',
            'columns' => array('id_ouvinte'),
            'refColumns' => 'id_ouvinte'
        )
    );
    
    public function getOuvintes(){
        $select = $this->select()->order('nome asc');
        return $this->fetchAll($select);
    }
    public function getOuvintesNaoPagos(){
        $select = $this->select()->where('pagamento = ?','naopago')
                ->order('nome asc');
        return $this->fetchAll($select);
    }
    public function getOuvintesPagos(){
        $select = $this->select()->where('pagamento = ?','pago')
                ->order('nome asc');
        return $this->fetchAll($select);
    }
    public function getOuvintesIsentos(){
        $select = $this->select()->where('pagamento = ?','isento')
                ->order('nome asc');
        return $this->fetchAll($select);
    }
    
    public function getOuvintesNaoImpresso(){
        $select = $this->select()->where('impresso = ?','0')
                ->order('nome asc');
        return $this->fetchAll($select);
    }
    
    public function getOuvintesImpresso(){
        $select = $this->select()->where('impresso = ?','1')
                ->order('nome asc');
        return $this->fetchAll($select);
    }
    
    public function getByCodigoBarras($codigo_barras){
        $select = $this->select()->where('codigo_barras = ?',$codigo_barras);
        return $this->fetchRow($select);
    }
    
    public function existeCodigoBarras($codigo){
        $select = $this->select()->where('codigo_barras = ?',$codigo);
        $row = $this->fetchRow($select);
        if(is_null($row)){
            return false;
        }else{
            return true;
        }
    }
    
    public function marcarCodigoBarrasImpressos(){
        $where = $this->getAdapter()->quoteInto('where impresso = ?', '0');
        $this->update(array('impresso' => 1), $where);
    }


}

