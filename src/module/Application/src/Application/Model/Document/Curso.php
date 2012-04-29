<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Curso {

    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;

    /**
     * Descrição: Metodo getId, responsavel por buscar o valor da variável $id.
     * @return int $id 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * Descrição: metodo getNome, responsavel por pegar o nome da variável "$nome".
     * @return string $nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Descrição: Metodo setId, responsavel por setar a informação recebida por parametro($id) na variável id.
     * @param tipo string $id 
     * @return int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * Descrição: Metodo setNome, responsavel por setar a informação recebida por parametro($nome) na variável nome.
     * @param tipo string $nome
     * @return string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

}