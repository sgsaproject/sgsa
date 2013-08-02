<?php

class Application_Form_CadastroPalestra extends Zend_Form {

    public function init() {

        $this->setMethod('post');

        $nome_palestra = new Zend_Form_Element_Text('nome_palestra');
        $nome_palestra->setLabel('Nome da Palestra:')
                ->addFilter('StripTags')
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite o nome da palestra neste campo.')
                ->setRequired(TRUE);
        $this->addElement($nome_palestra);

        $nome_palestrante = new Zend_Form_Element_Text('nome_palestrante');
        $nome_palestrante->setLabel('Nome do Palestrante:')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->addFilter('StripTags')
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite o nome do palestrante neste campo.')
                ->setRequired(TRUE);
        $this->addElement($nome_palestrante);

        $instituicao = new Zend_Form_Element_Text('instituicao');
        $instituicao->setLabel('Instituição:')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->setAttrib('size', '60')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite a instituição neste campo. Ex.: UNIPAMPA, URCAMP')
                ->addFilter('StripTags');
        $this->addElement($instituicao);

        $data = new ZendX_JQuery_Form_Element_DatePicker('data_palestra');
        $data->setLabel('Data da Palestra:')
             ->addValidator(new Zend_Validate_Date(array('format' => 'dd/MM/yyyy')))
             ->setJQueryParam('dateFormat', 'dd/mm/yy')
             ->setRequired(true);
        $this->addElement($data);
        
        $horas = array();
        $date = new Zend_Date('06:00:00', 'HH:mm:ss');
        for ($index = 0; $index < 36; $index++) {
            $horas[$date->get('HH:mm:ss')] = $date->get('HH:mm:ss');
            $date->addMinute(30);
        }

        $inicio_prev = new Zend_Form_Element_Select('hora_inicio_prevista');
        $inicio_prev->setLabel('Horário Prev de Início:')
                ->setRequired(TRUE)
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Hora de Previsão de Início da Palestra.')
                ->setMultiOptions($horas);
        $this->addElement($inicio_prev);

        $fim_prev = new Zend_Form_Element_Select('hora_fim_prevista');
        $fim_prev->setLabel('Horário Prev. de Fim')
                ->setRequired(TRUE)
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Hora de Previsão de Término da Palestra.')
                ->setMultiOptions($horas);
        $this->addElement($fim_prev);
        
        $sala = new Zend_Form_Element_Text('sala');
        $sala->setLabel('Sala:')
                ->addValidator('alnum', false, array('allowWhiteSpace' => true))
                ->setAttrib('size', '30')
                ->setAttrib('rel', 'tooltip')
                ->setAttrib('title', 'Digite o número da sala que acontecerá a palestra.')
                ->addFilter('StripTags');
        $this->addElement($sala);

        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel("Cadastrar Palestra")
                ->setAttrib('class', 'button');
        $this->addElement($submit);

    }

}
