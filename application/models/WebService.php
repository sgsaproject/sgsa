<?php

/**
 * Description of WebService
 *
 * @author Rafael
 */
class Application_Model_WebService {

    /**
     * Faz pedido de um token
     * @param string $login
     * @param string $senha
     * @return string token
     */
    public function getToken($login, $senha) {
        try {
            $userDbTable = new Application_Model_DbTable_Usuario();
            $select = $userDbTable->select()
                    ->where('login = ?', $login)
                    ->where('senha = ?', $senha);
            $user = $userDbTable->fetchRow($select);
            if (is_null($user)) {
                return "dados invalidos";
            }
            $tokenDbTable = new Application_Model_DbTable_Token();
            $token = $tokenDbTable->createRow();
            /* @var $token Application_Model_Token */
            $token->gerarToken();
            $token->setUsuario($user);
            $token->setDataCriacao();
            $token->save();
            return $token->getToken();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Retorna uma lista de ouvintes
     * @param string $token
     * @return array ouvintes
     */
    public function getOuvintes($token) {
        $this->checkToken($token);
        $ouvinteDbTable = new Application_Model_DbTable_Ouvinte();
        $ouvinteRowSet = $ouvinteDbTable->fetchAll();
        $ouvintes = array();
        foreach ($ouvinteRowSet as $ouvinteRow) {
            $ouvinte = new stdClass();
            $ouvinte->nome = $ouvinteRow->nome;
            $ouvinte->codigo_barras = $ouvinteRow->codigo_barras;
            $ouvintes[] = $ouvinte;
        }
        return $ouvintes;
    }
    /**
     * Retorna uma lista de palestras
     * @param string $token
     * @return array palestras
     */
    public function getPalestras($token) {
        $this->checkToken($token);
        $palestraDbTable = new Application_Model_DbTable_Palestra();
        $palestraRowSet = $palestraDbTable->fetchAll();
        $palestras = array();
        foreach ($palestraRowSet as $palestraRow) {
            $palestra = new stdClass();
            $palestra->id_palestra = $palestraRow->id_palestra;
            $palestra->nome_palestra = $palestraRow->nome_palestra;
            $palestra->nome_palestrante = $palestraRow->nome_palestrante;
            $palestra->instituicao = $palestraRow->instituicao;
            $palestra->hora_inicio_prevista = $palestraRow->hora_inicio_prevista;
            $palestra->hora_fim_prevista = $palestraRow->hora_fim_prevista;
            $palestra->hora_inicio = $palestraRow->hora_inicio;
            $palestra->hora_fim = $palestraRow->hora_fim;
            $palestra->sala = $palestraRow->sala;
            $palestras[] = $palestra;
        }
        return $palestras;
    }

    private function checkToken($token) {
        try {
            $token = new Application_Model_DbTable_Token();
            if ($token->existeToken($token) == false) {
                return array('token invalido');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

