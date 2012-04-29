<?php
namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class TipoUsuario {

    /** @ODM\Id */
    private $id;

    /** @ODM\Field (type="string") */
    private $nome;

    /**
     * Responsável por buscar o valor da variável $id.
     * @return int $id 
     */
    public function getId() {

        return $this->id;
    }

    /**
     * 
     * Responsável por pegar o nome da variável "$nome".
     * @return string $nome
     */
    public function getNome() {

        return $this->nome;
    }

    /**
     * Responsável por setar a informação recebida por parametro($ID) na variável ID.
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

}
