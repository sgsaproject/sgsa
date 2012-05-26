<?php

    class Application_Form_AdicionaFiscais extends Zend_Form {
        
        public function init(){
            
            $this->setMethod('post');
            
            $ouvinte = new Zend_Form_Element_Text('id_ouvinte');
            $ouvinte->setLabel('Código do Ouvinte:')
                    ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                    ->addFilter('StripTags')
                    ->setAttrib('size', '60')
                    ->setAttrib('rel', 'tooltip')
                    ->setAttrib('title', 'Escaneie ou digite o código de barras do crachá.')
                    ->setRequired(TRUE);
            $this->addElement($ouvinte);
            
            $submit = new Zend_Form_Element_Submit('enviar');
            $submit->setLabel('Adicionar Ouvinte')
                   ->setAttrib('class', 'button');
            $this->addElement($submit);
            
        }
        
    }
