<?php

    class Application_Form_AdicionaFiscais extends Zend_Form {
        
        public function init(){
            
            $this->setMethod('post');
            
            $fiscais[] = isset($fiscais) ? '' : '';
            $fiscalModel = new Application_Model_DbTable_Usuario();
            $fiscalObj = $fiscalModel->getUsuariosColaborador();
            foreach($fiscalObj as $f){
                $fiscais[$f->id_usuario] = $f->nome;
            }
            
            $fiscal = new Zend_Form_Element_Select('id_usuario');
            $fiscal->setLabel('Selecione o fiscal:')
                    ->addMultiOptions($fiscais)
                    ->setAttrib('rel', 'tooltip')
                    ->setAttrib('title', 'Selecione o nome do fiscal da palestra')
                    ->setRequired(TRUE);
            $this->addElement($fiscal);
            
            $submit = new Zend_Form_Element_Submit('enviar');
            $submit->setLabel("Cadastrar Fiscal")
                   ->setAttrib('class', 'button');
            $this->addElement($submit);
            
        }
        
    }
