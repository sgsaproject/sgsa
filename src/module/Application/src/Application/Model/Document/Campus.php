<?php

namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Campus
{

    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $nome;
	
	/** @ODM\ReferenceMany(targetDocument="Curso") */
	private $cursos = array();
	
	/** @ODM\ReferenceMany(targetDocument="Evento") */
	private $eventos = array();
	
	/** @ODM\ReferenceMany(targetDocument="Local") */
	private $locais = array();

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
	 * @return os cursos associados
	 */
	public function getCursos()
	{
		return $this->cursos;
	}
	
	/**
	 * @return os eventos associados
	 */
	public function getEventos()
	{
		return $this->eventos;
	}
	
	/**
	 * @return os locais associados
	 */
	public function getLocais()
	{
		return $this->locais;
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
     * @param field_type $cursos
     */
    public function setCursos(array $cursos)
    {
        $this->cursos = $cursos;
    }
	
	/**
     * @param field_type $eventos
     */
    public function setEventos(array $eventos)
    {
        $this->eventos = $eventos;
    }
	
	/**
     * @param field_type $locais
     */
    public function setLocais(array $locais)
    {
        $this->locais = $locais;
    }

}
