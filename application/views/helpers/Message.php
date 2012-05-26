<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Message
 *
 * @author Rafael
 */
class Zend_View_Helper_Message extends Zend_View_Helper_Abstract {

    public function Message() {
        $view = new Zend_View();
        $view->setScriptPath(APPLICATION_PATH . '/views');
        //Verifica se há mensagens do sistema
        $info = new Zend_Session_Namespace('sacta');
        $msg = '';
        if (!empty($info->mensagem)) {
            $msg = $view->partial('scripts/layout/message.phtml', array(
                        'title' => 'Mensagem de Informação',
                        'mensagem' => $info->mensagem));
            unset($info->mensagem);
        } 
        return $msg;
    }

}

?>
