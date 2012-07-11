<?php

class Application_Model_Ouvinte {

    private $palestras;

    public function getId_ouvinte() {
        return $this->id_ouvinte;
    }

    public function setId_ouvinte($idOuvinte) {
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

    public function setPagamento() {
        $this->pagamento = pagamento;
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

    public function getCodigo_barras() {
        return $this->codigo_barras;
    }

    public function setCodigo_barras($codigoBarras) {
        $tamanho = 6;
        if (strlen($codigoBarras) !== $tamanho) {
            throw new Application_Model_Ouvite_Exception('Tamanho do código de barras incorreto. Tamanho informado: ' . $codigoBarras . '. Tamanho máximo: ' . $tamanho);
        } else {
            $this->codigo_barras = $codigoBarras;
        }
    }

}