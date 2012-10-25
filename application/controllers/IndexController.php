<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->prepend('Página Inicial');
    }

    public function indexAction() {
    }

    public function gerarCodigoBarrasAction() {
        $this->_helper->layout->disableLayout();
        //pega por get ou post a variavel code
        $code = $this->getRequest()->getParam('code');
        //monta configuracao codigo de barras       
        $config = new Zend_Config(array(
                    'barcode' => 'code39',
                    'barcodeParams' => array('text' => $code),
                    'renderer' => 'image',
                    'rendererParams' => array('imageType' => 'jpg'),
                ));

        $renderer = Zend_Barcode::factory($config);
        //renderiza o codigo de barras 
        $renderer->render();
    }

    public function codigoBarrasAction() {
        $this->_helper->layout->disableLayout();
        //pega por get ou post a variavel code
        $code = $this->getRequest()->getParam('code');

        if (file_exists(PUBLIC_PATH . '/media/codigos_barras/' . $code . '.jpg')) {
            //codigo de barras existe 
            $this->_redirect('http://' . $_SERVER['HTTP_HOST'] . $this->view->baseUrl('/media/codigos_barras/' . $code . '.jpg'));
        } else {
            //codigo de barras nao existe
            $file = 'http://' . $_SERVER['HTTP_HOST'] . $this->view->baseUrl('/index/gerar-codigo-barras/code/' . $code);
            $current = file_get_contents($file);
            file_put_contents(PUBLIC_PATH . '/media/codigos_barras/' . $code . '.jpg', $current);
            $this->_redirect('http://' . $_SERVER['HTTP_HOST'] . $this->view->baseUrl('/media/codigos_barras/' . $code . '.jpg'));
        }
    }

    public function testeAction() {
        $this->_helper->layout->disableLayout();
        $stream = file_get_contents('http://localhost/sacta2011/public/index/codigo-barras/code/12345555');
        $f = fopen('codebar.jpg', 'w');
        fwrite($f, $stream);
        fclose($f);
        //ou 
        $file = 'http://localhost/sacta2011/public/index/codigo-barras/code/12354545555';
        $current = file_get_contents($file);
        file_put_contents('codebar2.jpg', $current);
    }

    public function pdfAction() {
        $this->_helper->layout->disableLayout();

        $pdf = new Sistema_PDF_Creator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);


// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(0, PDF_MARGIN_TOP, 0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
        $pdf->SetFont('helvetica', '', 10);


// define barcode style
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 1
        );


        $pdf->AddPage();

        $pdf->resetColumns();

        $pdf->setEqualColumns(3, 100);
        $ouvintesModel = new Application_Model_DbTable_Ouvinte();
        $tipo = $this->getRequest()->getParam('tipo');
        if ($tipo == 'naoimpresso') {
            $ouvintes = $ouvintesModel->getOuvintesNaoImpresso();
        } else if ($tipo == 'impresso') {
            $ouvintes = $ouvintesModel->getOuvintesImpresso();
        }

        foreach ($ouvintes as $ouvinte) {
            $style['position'] = 'C';
            $pdf->Write(1, $this->view->FormatarNome($ouvinte->nome), '', '', 'C', true);
            $pdf->Write(6, $this->view->FormatarNome($ouvinte->instituicao), '', '', 'C', true);
            $pdf->Write(6, $this->view->FormatarNome($ouvinte->curso), '', '', 'C', true);
            $pdf->write1DBarcode($ouvinte->codigo_barras, 'C39', '', '', '', 0, 0.4, $style, 'T');
            $pdf->Ln(25);
        }

        if ($tipo == 'naoimpresso') {
            foreach ($ouvintes as $ouvinte) {
                $ouvinte->impresso = 1;
                $ouvinte->save();
            }
        }

        $pdf->Output('Codigo_Barras.pdf', 'I');
    }

    public function cronAction() {
        $emailPendenteModel = new Application_Model_DbTable_EmailPendente();
        $row = $emailPendenteModel->getEmail();
        if (!is_null($row)) {

            $ouvinteModel = new Application_Model_DbTable_Ouvinte();
            $ouvinte = $ouvinteModel->find($row->id_ouvinte)->current();
            echo $row->id_ouvinte . '<br/>';
            echo 'Ouvinte: ' . $ouvinte->nome . ' email: ' . $ouvinte->email . '<br/>';

            $msg = $this->view->partial('/layout/templates/emailConfirmacao.phtml', array(
                'nome' => $ouvinte->nome
                    ));

            try {
                $mail = new Zend_Mail('utf-8');
                $mail->setFrom('saadmlivramento@gmail.com')
                        ->setReplyTo('saadmlivramento@gmail.com')
                        ->addTo($ouvinte->email)
                        ->setBodyHtml($msg)
                        ->setSubject('Inscrição Semana Acadêmica 2011')
                        ->send(Zend_Registry::get('transport'));
                echo 'Status: Enviado';
                $row->delete();
            } catch (Exception $e) {
                echo 'Status: Erro ao Enviar';
                echo $e->getMessage();
            }
        }
    }

    public function loteriaAction() {
        $this->_helper->layout->disableLayout();

        $pdf = new Sistema_PDF_Creator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 013');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 013', PDF_HEADER_STRING);

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
        $pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set font
        $pdf->SetFont('helvetica', 'B', 20);

// add a page
        $pdf->AddPage();

        $pdf->Write(0, 'Graphic Transformations', '', 0, 'C', 1, 0, false, false, 0);

// set font
        $pdf->SetFont('helvetica', '', 10);

// --- Scaling ---------------------------------------------
        $pdf->SetDrawColor(200);
        $pdf->SetTextColor(200);
        $pdf->Rect(50, 70, 40, 10, 'D');
        $pdf->Text(50, 66, 'Scale');
        $pdf->SetDrawColor(0);
        $pdf->SetTextColor(0);
// Start Transformation
        $pdf->StartTransform();
// Scale by 150% centered by (50,80) which is the lower left corner of the rectangle
        $pdf->ScaleXY(150, 50, 80);
        $pdf->Rect(50, 70, 40, 10, 'D');
        $pdf->Text(50, 66, 'Scale');
// Stop Transformation
        $pdf->StopTransform();

//Close and output PDF document
        $pdf->Output('example_013.pdf', 'I');
    }

}

