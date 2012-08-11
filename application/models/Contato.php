<?php

class Application_Model_Contato {

    use Sistema_Model_Utils;

    private $nome;
    private $email;
    private $telefone;
    private $mensagem;
    private $assunto;

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function getAssunto() {
        return $this->assunto;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function enviarEmail() {
        $view = new Zend_View();
        $view->setScriptPath(APPLICATION_PATH . '/views/scripts/layout/templates/');
        $emailContato = $view->partial('emailContato.phtml',
                array('assunto' => $this->getAssunto(),
                    'email' => $this->getEmail(),
                    'mensagem' => $this->getMensagem(),
                    'nome' => $this->getNome(),
                    'telefone' => $this->getTelefone()));

        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);

        $mail = new Zend_Mail('utf-8');
        $mail->setFrom($this->email)
                ->setReplyTo($this->email)
                ->addTo($config->resources->mail->defaultfrom->email)
                ->setBodyHtml($emailContato)
                ->setSubject('Contato Semana Acadêmica - ' . $this->assunto)
                ->send();
    }

}

