<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Instituicao
{

    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;
	
	/** @ODM\ReferenceMany(targetDocument="Campus") */
	private $campi = array();

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $nome
     */
    public function getNome()
    {
        return $this->nome;
    }
	
	/**
	 * Retorna todos os campi associados com a Instituição
     * @return the $campi
     */
    public function getCampi()
    {
        return $this->campi;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param field_type $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
	
	/**
	 * Seta os campi associados com a Instituição
     * @param field_type $campi
     */
    public function setCampi($campi)
    {
        $this->campi = $campi;
    }
	
}
