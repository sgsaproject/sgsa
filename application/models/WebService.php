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
            return "786sad7gsad78sad678sadg87sad6";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

