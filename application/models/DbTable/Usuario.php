<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract {

    protected $_name = 'usuario';
    protected $_dependentTables = array(
        'Application_Model_DbTable_TipoUsuario',
        'Application_Model_DbTable_Permissao',
        'Application_Model_DbTable_Sessao');
    protected $_rowClass = 'Application_Model_Usuario';
    protected $_referenceMap = array(
        'TipoUsuario' => array(
            'refTableClass' => 'Application_Model_DbTable_Permissao',
            'columns' => array('id_usuario'),
            'refColumns' => 'id_usuario'
        ),
        'Sessao' => array(
            'refTableClass' => 'Application_Model_DbTable_Sessao',
            'columns' => array('id_usuario'),
            'refColumns' => 'id_usuario'
        )
    );

    public function getUsuarios() {
        $select = $this->select()->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuariosColaborador() {
        $select = $this->select()->where('id_tipo_usuario = 2')
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuariosOrganizador() {
        $select = $this->select()->where('id_tipo_usuario = 1')
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuarioById($idUsuario) {
        return $this->find($idUsuario)->current();
    }

    public function getUsuariosNaoPagos() {
        $select = $this->select()->where('pagamento = ?', Application_Model_Usuario::NAO_PAGO)
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuariosPagos() {
        $select = $this->select()->where('pagamento = ?', Application_Model_Usuario::PAGO)
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuariosIsentos() {
        $select = $this->select()->where('pagamento = ?', Application_Model_Usuario::ISENTO)
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuariosNaoImpresso() {
        $select = $this->select()->where('impresso = ?', '0')
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getUsuariosImpresso() {
        $select = $this->select()->where('impresso = ?', '1')
                ->order('nome asc');
        return $this->fetchAll($select);
    }

    public function getByCodigoBarras($codigo_barras) {
        $select = $this->select()->where('codigo_barras = ?', $codigo_barras);
        return $this->fetchRow($select);
    }

    public function existeCodigoBarras($codigo) {
        $select = $this->select()->where('codigo_barras = ?', $codigo);
        $row = $this->fetchRow($select);
        if (is_null($row)) {
            return false;
        } else {
            return true;
        }
    }

    public function marcarCodigoBarrasImpressos() {
        $where = $this->getAdapter()->quoteInto('where impresso = ?', '0');
        $this->update(array('impresso' => 1), $where);
    }

    public function inserirUsuario(array $dados) {
        parent::insert($dados);
    }

    public function getUsuariosEmailNaoConfirmado() {
        $select = $this->select()->where('email_confirmado = 0');
        return $this->fetchAll($select);
    }

}