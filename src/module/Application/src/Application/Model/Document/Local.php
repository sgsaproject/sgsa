<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Local
{ 

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
     * @return the $palestras
     */
    public function getPalestras()
    {
        return $this->palestras;
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
     * @param field_type $palestras
     */
    public function setPalestras($palestras)
    {
        $this->palestras = $palestras;
    }
	
}
