<?php

class Application_Model_Usuario extends Zend_Db_Table_Row_Abstract {
    use Sistema_Model_Utils;
    
    private $tipoUsuario;
    private $palestras;
    private $sessoes;

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
    
    public function getRg() {
        return $this->rg;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }
    
    public function getCurso() {
        return $this->curso;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function getInstituicao() {
        return $this->instituicao;
    }

    public function setInstituicao($instituicao) {
        $this->instituicao = $instituicao;
    }

    public function getPagamento() {
        return $this->pagamento;
    }

    public function setPagamento($pagamento) {
        $this->pagamento = $pagamento;
    }

    public function isImpresso() {
        if ($this->impresso || $this->impresso == 1) {
            return true;
        }
        return false;
    }

    public function setImpresso($impresso) {
        $this->impresso = $impresso;
    }

    public function getCodigoBarras() {
        return $this->codigo_barras;
    }

    public function setCodigoBarras($codigoBarras) {
        $tamanho = 5;
        if (strlen($codigoBarras) !== $tamanho) {
            throw new Application_Model_UsuarioException('Tamanho do código de barras incorreto. Tamanho informado: ' . strlen($codigoBarras) . '. Tamanho correto: ' . $tamanho);
        } else if ($codigoBarras < 0) {
            throw new Application_Model_UsuarioException('Código de barras inválido. O código de barras deve ser maior ou igual a 0.');
        } else {
            $this->codigo_barras = $codigoBarras;
        }
    }

    public function getSessoes() {
        if (is_null($this->sessoes)) {
            $sessaoDAO = new Application_Model_DbTable_Sessao();
            $this->sessoes = $sessaoDAO->getSessoesOfUsuarioById($this->id_usuario);
        }
        return $this->sessoes;
    }

    public function enviarEmailConfirmacao(Zend_Mail_Transport_Abstract $transport = null) {
        $view = new Zend_View();
        $view->setScriptPath(APPLICATION_PATH . '/views/scripts');
        $msg = $view->partial('/layout/templates/emailConfirmacao.phtml', array(
            'nome' => $this->nome
                ));

        try {
            $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', APPLICATION_ENV);
            
            $mail = new Zend_Mail('utf-8');
            $mail->addTo($this->email)
                    ->setBodyHtml($msg)
                    ->setSubject('Inscrição na ' . $config->evento->nome . ' de ' . $config->evento->ano)
                    ->send($transport);
            
        } catch (Exception $e) {
            $date = new Zend_Date();
            $emailPendenteModel = new Application_Model_DbTable_EmailPendente();
            $emailPendenteModel->insert(array(
                'id_usuario' => $this->id_usuario,
                'data' => $date->get(Sistema_Data::ZEND_DATABASE_DATETIME)
            ));
        }
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

