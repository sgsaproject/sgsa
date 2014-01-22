<?php

class Application_Form_Usuario extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $idUsuario = new Zend_Form_Element_Text('id_usuario');
        $idUsuario->setLabel("ID Usuário: ")
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Identificador do usuário')
                ->setAttrib('size', '60')
                ->setAttrib('readonly', 'true');
        $this->addElement($idUsuario);

        $tipoModel = new Application_Model_DbTable_TipoUsuario();
        $tipoObj = $tipoModel->getTipoUsuario();
        foreach ($tipoObj as $tipoT) {
            $tipo[$tipoT->id_tipo_usuario] = $tipoT->nome;
        }

        $tipoUser = new Zend_Form_Element_Select('id_tipo_usuario');
        $tipoUser->setLabel('Tipo do Usuário:')
                ->addMultiOptions($tipo)
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Selecione o tipo do usuário')
                ->setAttrib('style', 'width: 338px;')
                ->setRequired(TRUE);
        $this->addElement($tipoUser);

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
                ->setRequired(true);
        $this->addElement($email);

//        $element = new Zend_Form_Element_Password('senha');
//        $element->setLabel('Senha:')
//                ->setAttrib('size', '60')
//                ->setAttrib('rel', 'tooltip')
//                ->setAttrib('title', 'Digite uma senha')
//                ->setRequired(true);
//        $this->addElement($element);

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
        
        $codigoBarras = new Zend_Form_Element_Text('codigo_barras');
        $codigoBarras->setLabel("Código de Barras: ")
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Código de Barras')
                ->setAttrib('size', '60')
                ->setAttrib('readonly', 'true');
        $this->addElement($codigoBarras);

        $pagamentos[Application_Model_Usuario::PAGO] = "Pago";
        $pagamentos[Application_Model_Usuario::NAO_PAGO] = "Não Pago";
        $pagamentos[Application_Model_Usuario::ISENTO] = "Isento";

        $pagamento = new Zend_Form_Element_Select('pagamento');
        $pagamento->setLabel('Tipo de Pagamento: ')
                ->addMultiOptions($pagamentos)
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('style', 'width: 338px;')
                ->setAttrib('title', 'Selecione o tipo de pagamento')
                ->setRequired(TRUE);
        $this->addElement($pagamento);

        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel('Efetuar Pré-Inscrição')
                ->setAttrib('class', 'button');
        $this->addElement($submit);
    }

}