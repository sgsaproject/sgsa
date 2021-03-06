<?php
namespace Application\Model\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document */
class Campus {

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
     * Descrição: Metodo getId, responsavel por buscar o valor da variável $id.
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
     * 
     * Responsável por retornar o curso associado.
     * @return array cursos
     */
    public function getCursos() {
        return $this->cursos;
    }

    /**
     * 
     * Responsável por retornar o evento associado.
     * @return array eventos
     */
    public function getEventos() {
        return $this->eventos;
    }

    /**
     * 
     * Responsável por retornar o local associado.
     * @return array locais
     */
    public function getLocais() {
        return $this->locais;
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
     * Responsável por setar as informações recebidas por parametro($cursos) no array cursos.
     * @param tipo array $cursos
     * @return array $cursos
     */
    public function setCursos(array $cursos) {
        $this->cursos = $cursos;
    }

    /**
     * 
     * Responsável por setar as informações recebidas por parametro($eventos) no array eventos.
     * @param tipo array $eventos
     * @return array $eventos
     */
    public function setEventos(array $eventos) {
        $this->eventos = $eventos;
    }

    /**
     * Responsável por setar as informações recebidas por parametro($cursos) no array locais.
     * @param tipo array $locais
     * @return array $locais
     */
    public function setLocais(array $locais) {
        $this->locais = $locais;
    }

}
