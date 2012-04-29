﻿<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Instituicao {

    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;

    /** @ODM\ReferenceMany(targetDocument="Campus") */
    private $campi = array();

    /**
     * Responsavel por buscar o valor da variável $id.
     * @return int $id 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * Responsavel por pegar o nome da variável "$nome".
     * @return string $nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * 
     * Responsavel por retornar os campi associados com a Instituição
     * @return array campi
     */
    public function getCampi() {
        return $this->campi;
    }

    /**
     * Responsavel por setar a informação recebida por parametro($id) na variável id.
     * @param tipo string $id 
     * @return int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * Responsavel por setar a informação recebida por parametro($nome) na variável nome.
     * @param tipo string $nome
     * @return string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

    /**
     * 
     * Responsavel por setar as informações recebidas por parametro($campi) no array de campi associados com a Instituição.
     * @param tipo array $campi
     * @return array $campi
     */
    public function setCampi($campi) {
        $this->campi = $campi;
    }

}
