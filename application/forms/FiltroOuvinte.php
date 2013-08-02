<?php

class Application_Form_FiltroUsuario extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome: ')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addValidator('stringlength', false, array(4, 40))
                ->addFilter('StripTags')
                ->setAttrib('size', '60');
        $this->addElement($nome);

        $rg = new Zend_Form_Element_Text('rg');
        $rg->setLabel('RG: ')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addFilter('StripTags')
                ->setAttrib('size', '60');
        $this->addElement($rg);

        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail: ')
                ->addValidator('EmailAddress')
                ->addValidator($validator)
                ->setAttrib('size', '60');
        $this->addElement($email);



        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel('Efetuar Pré-Inscrição')
                ->setAttrib('class', 'button');
        $this->addElement($submit);

    }

}