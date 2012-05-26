<?php

class Application_Form_Contato extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome:')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->setAttrib('size', '60')
                ->addFilter('StripTags')
                ->setRequired(TRUE);
        $this->addElement($nome);

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
                ->addValidator('EmailAddress')
                ->setAttrib('size', '60')
                ->addFilters(array('StringTrim', 'StringtoLower'))
                ->setRequired(TRUE);
        $this->addElement($email);

        $telefone = new Zend_Form_Element_Text('telefone');
        $telefone->setLabel('Telefone:')
                ->setAttrib('size', '60')
                ->addFilter('StripTags', 'HtmlEntities');
        $this->addElement($telefone);


        $assunto = new Zend_Form_Element_Text("assunto");
        $assunto->setLabel('Assunto:')
                ->addFilter('StripTags', 'HtmlEntities')
                ->setAttrib('size', '60')
                ->setRequired(TRUE)
                ->addValidator('stringLength', false, array(2, 32));
        $this->addElement($assunto);


        $mensagem = new Zend_Form_Element_Textarea('mensagem');
        $mensagem->setLabel('Mensagem:')
                ->setRequired(TRUE)
                ->addFilters(array('StripTags', 'HtmlEntities'))
                ->setAttrib('cols', 50)
                ->setAttrib('rows', 6);
        $this->addElement($mensagem);


        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel("Enviar Mensagem")
                ->setAttrib('class', 'button');
        $this->addElement($submit);

    }

}
