<?php

class Application_Form_Reenviar extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail: ')
                ->addValidator('EmailAddress')
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite um e-mail válido. Você receberá as informações neste e-mail')
                ->addFilters(array('StringTrim', 'StringtoLower'))
                ->setRequired(true);
        $this->addElement($email);
        
        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel('Reenviar e-mail de inscrição')
                ->setAttrib('class', 'button');
        $this->addElement($submit);

    }

}