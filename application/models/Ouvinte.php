<?php

class Application_Model_Ouvinte extends Zend_Db_Table_Row_Abstract {

    private $sessoes;

    public function getId() {
        return $this->id_ouvinte;
    }

    public function setId($idOuvinte) {
        $this->id_ouvinte = $idOuvinte;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getRg() {
        return $this->rg;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
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
            throw new Application_Model_OuvinteException('Tamanho do código de barras incorreto. Tamanho informado: ' . strlen($codigoBarras) . '. Tamanho correto: ' . $tamanho);
        } else if ($codigoBarras < 0) {
            throw new Application_Model_OuvinteException('Código de barras inválido. O código de barras deve ser maior ou igual a 0.');
        } else {
            $this->codigo_barras = $codigoBarras;
        }
    }
    
    public function getSessoes() {
        if (is_null($this->sessoes)) {
            $sessaoDAO = new Application_Model_DbTable_Sessao();
            $this->sessoes = $sessaoDAO->getSessoesOfOuvinteById($this->id_ouvinte);
        }
        return $this->sessoes;
    }

}