<?php

class Application_Form_Inscricao extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome: ')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addValidator('StringLength', false, array(4, 40))
                ->addFilter('StripTags')
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite seu nome completo')
                ->setRequired(TRUE);
        $this->addElement($nome);

        $rg = new Zend_Form_Element_Text('rg');
        $rg->setLabel('RG: ')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addFilter('StripTags')
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite o número do seu documento de identidade')
                ->setRequired(TRUE);
        $this->addElement($rg);

        
        $validator = new Zend_Validate_Db_NoRecordExists('usuario', 'email'); // usuarios is the table name, and email is the column
        $validator->setMessage("Erro: Já foi feita uma inscrição neste email.");

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail: ')
                ->addValidator('EmailAddress')
                ->addValidator($validator)
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite um e-mail válido. Você receberá as informações neste e-mail')
                ->addFilters(array('StringTrim', 'StringtoLower'))
                ->setRequired(TRUE);
        $this->addElement($email);

        $curso = new Zend_Form_Element_Text('curso');
        $curso->setLabel('Curso: ')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addValidator('stringlength', false, array(4, 40))
                ->addFilter('StripTags')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite seu curso. Ex.: Engenharia de Software')
                ->setAttrib('size', '60')
                ->setRequired(FALSE);
        $this->addElement($curso);

        $instituicao = new Zend_Form_Element_Text('instituicao');
        $instituicao->setLabel('Instituição: ')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addValidator('stringlength', false, array(4, 40))
                ->addFilter('StripTags')
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Ex.: Unipampa, Urcamp, Comunidade, Sem Vinculo,...')
                ->setRequired(TRUE);
        $this->addElement($instituicao);

        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel('Efetuar Pré-Inscrição')
                ->setAttrib('class', 'button');
        $this->addElement($submit);

    }

}