<?php

class ProgramacaoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $palestraModel = new Application_Model_DbTable_Palestra();
        $this->view->palestras =  $palestraModel->getPalestras();
    }


}

