<?php

/**
 * Description of WebService
 *
 * @author Rafael
 */
class Application_Model_WebService {

    /**
     * Faz pedido de um token
     * @param string $usuario
     * @param string $senha
     * @return string token
     */
    public function getToken($usuario, $senha) {
        try {
            $userDbTable = new Application_Model_DbTable_Usuario();
            $select = $userDbTable->select()
                    ->where('usuario = ?', $usuario)
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
     * Retorna uma lista de usuarios
     * @param string $token
     * @return array usuarios
     */
    public function getUsuarios($token) {
        try {
            $this->checkToken($token);
            $usuarioDbTable = new Application_Model_DbTable_Usuario();
            $usuarioRowSet = $usuarioDbTable->fetchAll();
            $usuarios = array();
            foreach ($usuarioRowSet as $usuarioRow) {
                $usuario = new stdClass();
                $usuario->nome = $usuarioRow->nome;
                $usuario->email = $usuarioRow->email;
                $usuario->usuario = $usuarioRow->usuario;
                $usuario->codigo_barras = $usuarioRow->codigo_barras;
                $usuario->pagamento = $usuarioRow->pagamento;
                $usuarios[] = $usuario;
            }
            return $usuarios;
        } catch (Exception $e) {
            return array($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Retorna uma lista de palestras
     * @param string $token
     * @return array palestras
     */
    public function getPalestras($token) {
        try {
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
        } catch (Exception $e) {
            return array($e->getMessage(), $e->getCode());
        }
    }

    private function checkToken($token) {
        $tokenDbTable = new Application_Model_DbTable_Token();
        if ($tokenDbTable->existeToken($token) == false) {
            throw new Exception('invalid token', 600);
        }
    }

    /**
     * Envia lista de sessões
     * @param string $token
     * @param array $sessions 
     * @return string
     */
    public function uploadSessions($token, array $sessions) {
        try {
            $this->checkToken($token);
            return var_export($sessions, true);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

