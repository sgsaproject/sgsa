<?php
    
    class Application_Form_Usuarios extends Zend_Form {
        
        public function init(){
            
            $this->setMethod('post');
            
            $nome = new Zend_Form_Element_Text('nome');
            $nome->setLabel('Nome:')
                 ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                 ->addFilter('StripTags')
                 ->setAttrib('rel', 'tooltip')
                 ->setAttrib('title', 'Digite o nome do usuário')
                 ->setAttrib('size', '60')
                 ->setRequired(TRUE);
            $this->addElement($nome);
            
            $email = new Zend_Form_Element_Text('email');
            $email->setLabel('E-mail:')
                  ->addValidator('EmailAddress')
                  ->addFilters(array('StringTrim', 'StringtoLower'))
                  ->setAttrib('rel', 'tooltip')
                  ->setAttrib('title', 'Digite o e-mail do usuário')
                  ->setAttrib('size', '60')
                  ->setRequired(TRUE);
            $this->addElement($email);
            
            $usuario = new Zend_Form_Element_Text('usuario');
            $usuario->setLabel('Usuário:')
                  ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                  ->addFilter('StripTags')
                  ->setAttrib('rel', 'tooltip')
                  ->setAttrib('title', 'Digite um usuario de acesso ao sistema para o usuário')
                  ->setAttrib('size', '60')
                  ->setRequired(TRUE);
            $this->addElement($usuario);
            
            $tipo[] = isset($tipo) ? '' : '';
            $tipoModel = new Application_Model_DbTable_TipoUsuario();
            $tipoObj = $tipoModel->getTipoUsuario();
            foreach($tipoObj as $tipoT){
                $tipo[$tipoT->id_tipo_usuario] = $tipoT->nome;
            }
            
            $tipoUser = new Zend_Form_Element_Select('id_tipo_usuario');
            $tipoUser->setLabel('Tipo do Usuário:')
                     ->addMultiOptions($tipo)
                     ->setAttrib('rel', 'tooltip')
                     ->setAttrib('title', 'Selecione o tipo do usuário')
                     ->setRequired(TRUE);
            $this->addElement($tipoUser);
            
            $senha = new Zend_Form_Element_Text('senha');
            $senha->setLabel('Senha:')
                  ->setAttrib('rel', 'tooltip')
                  ->setAttrib('title', 'Digite a senha de acesso para o usuário ao sistema')
                  ->setRequired(TRUE);
            $this->addElement($senha);
            
            $submit = new Zend_Form_Element_Submit('enviar');
            $submit->setLabel('Salvar')
                   ->setAttrib('class', 'button');
            $this->addElement($submit);
            
        }
        
    }
