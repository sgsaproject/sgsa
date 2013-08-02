<?php

    class Application_Form_AdicionaFiscais extends Zend_Form {
        
        public function init(){
            
            $this->setMethod('post');
            
            $usuario = new Zend_Form_Element_Text('id_usuario');
            $usuario->setLabel('Código do Usuario:')
                    ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                    ->addFilter('StripTags')
                    ->setAttrib('size', '60')
                    ->setAttrib('rel', 'tooltip')
                    ->setAttrib('title', 'Escaneie ou digite o código de barras do crachá.')
                    ->setRequired(TRUE);
            $this->addElement($usuario);
            
            $submit = new Zend_Form_Element_Submit('enviar');
            $submit->setLabel('Adicionar Usuario')
                   ->setAttrib('class', 'button');
            $this->addElement($submit);
            
        }
        
    }
