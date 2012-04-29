<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Evento {

    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;

    /**
     * Responsável por buscar o valor da variavel $id.
     * @return int $id 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * Responsável por pegar o nome da variavel "$nome".
     * @return string $nome
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Responsável por setar a informação recebida por parametro($ID) na variavel ID.
     * @param tipo string $id 
     * @return int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * Responsável por setar a informação recebida por parametro($nome) na variavel nome.
     * @param tipo string $nome
     * @return string $nome
     */
    public function setNome($nome) {
        $this->nome = $nome;
    }

}