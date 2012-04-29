<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Local {

    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;

    /** @ODM\ReferenceMany(targetDocument="Palestra") */
    private $palestras = array();
    private $sala;
    private $numeroSala;
    private $arCondicionado;
    private $numeroCadeiras;
    private $quadro;
    private $projetor;
    private $extensao;
    private $mesas;

    /** @ODM\Field(type="string") */
    private $outros;

    /**
     * Responsável por buscar o valor da variável $id.
     * @return int $id 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * Responsável por pegar o nome da variável $nome.
     * @return string $nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Responsável por pegar o nome da variável $palestras
     * @return string $palestras
     */
    public function getPalestras() {
        return $this->palestras;
    }

    /**
     * Responsável por pegar o nome da variável $sala
     * @return string $sala 
     */
    public function getSala() {
        return $this->sala;
    }

    /**
     * Responsável por pegar o nome da variável $numeroSala
     * @return string $numeroSala
     */
    public function getNumeroSala() {
        return $this->numeroSala;
    }

    /**
     * Responsável por pegar o nome da variável $arCondicionado
     * @return string $arCondicionado
     */
    public function getArCondicionado() {
        return $this->arCondicionado;
    }

    /**
     * Responsável por pegar o nome da variável $numeroCadeiras
     * @return string $numeroCadeiras
     */
    public function getNumeroCadeiras() {
        return $this->numeroCadeiras;
    }

    /**
     * Responsável por pegar o nome da variável $quadro
     * @return string $quadro 
     */
    public function getQuadro() {
        return $this->quadro;
    }

    /**
     * Responsável por pegar o nome da variável $projetor
     * @return string $projetor 
     */
    public function getProjetor() {
        return $this->projetor;
    }

    /**
     * Responsável por pegar o nome da variável $extensao
     * @return string $extensao
     */
    public function getExtensao() {
        return $this->extensao;
    }

    /**
     * Responsável por pegar o nome da variável $mesas
     * @return string $mesas
     */
    public function getMesas() {
        return $this->mesas;
    }

    /**
     * Responsável por pegar o nome da variável $outros
     * @return string $outros
     */
    public function getOutros() {
        return $this->outros;
    }

    /**
     * Responsável por setar a informação recebida por parametro($id) na variável id.
     * @param tipo string $id 
     * @return int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * Responsável por setar a informação recebida por parametro($nome) na variável nome.
     * @param tipo string $nome
     * @return string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

    /**
     * 
     * Responsável por setar a informação recebida por parametro($palestras) na variável palestras.
     * @param tipo string $palestras
     * @return string $palestras
     */
    public function setPalestras(array $palestras) {
        $this->palestras = $palestras;
    }

    /**
     * Responsável por setar a informação recebida por parametro($salas) na variável salas.
     * @param tipo string $salas 
     * @return string $salas 
     */
    public function setSala($salas) {
        $this->sala = $salas;
    }

    /**
     * Responsável por setar a informação recebida por parametro($numeroSala) na variável numeroSala.
     * @param tipo string $numeroSala 
     * @return string $numeroSala
     */
    public function setNumeroSala($numeroSala) {
        $this->numeroSala = $numeroSala;
    }

    /**
     * Responsável por setar a informação recebida por parametro($arCondicionado) na variável arCondicionado.
     * @param tipo string $arCondicionado 
     * @return string $arCondicionado 
     */
    public function setArCondicionado($arCondicionado) {
        $this->arCondicionado = $arCondicionado;
    }

    /**
     * Responsável por setar a informação recebida por parametro($numeroCadeiras) na variável numeroCadeiras.
     * @param tipo string $numeroCadeiras 
     * @return string $numeroCadeiras
     */
    public function setNumeroCadeiras($numeroCadeiras) {

        $this->numeroCadeiras = $numeroCadeiras;
    }

    /**
     * Responsável por setar a informação recebida por parametro($projetor) na variável projetor.
     * @param tipo string $projetor 
     * @return string $projetor
     */
    public function setProjetor($projetor) {
        $this->projetor = $projetor;
    }

    /**
     * Responsável por setar a informação recebida por parametro($extensao) na variável extensao.
     * @param tipo string $extensao 
     * @return string $extensao 
     */
    public function setExtensao($extensao) {

        $this->extensao = $extensao;
    }

    /**
     * Responsável por setar a informação recebida por parametro($mesas) na variável mesas.
     * @param tipo string $mesas 
     * @return string $mesas
     */
    public function setMesas($mesas) {
        $this->mesas = $mesas;
    }

    /**
     * Responsável por setar a informação recebida por parametro($outros) na variável outros.
     * @param tipo string $outros 
     * @return string $outros
     */
    public function setOutros($outros) {
        $this->outros = $outros;
    }

}
