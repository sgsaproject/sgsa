<?php

class CredenciamentoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function credenciarAction() {
        $usuarioDbTable = new Application_Model_DbTable_Usuario();
        /* @var $usuario Application_Model_Usuario */
        $usuario = $usuarioDbTable->find($this->getRequest()->getParam('id_usuario'))->current();

        $fPagamentoDAO = new Application_Model_DbTable_FormaPagamento();
        $formasPagamento = $fPagamentoDAO->getFormasPagamento();


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getParams();

            $pagamentoModel = new Application_Model_DbTable_Pagamento();
            /* @var $pagamento Application_Model_Pagamento */
            $pagamento = $pagamentoModel->createRow();
            $pagamento->setIdUsuario($usuario->getId());
            $pagamento->data = (new \DateTime())->format('Y-m-d H:i:s');

            if ($data['acao'] == 'pagar') {
                $pagamento->setIsento(false);
                $pagamento->setValor($data['valor']);
                $formaPagamento = $fPagamentoDAO->getFormaPagamentoByName($data['formaPagamento']);
                $pagamento->setIdFormaPagamento($formaPagamento->getIdFormaPagamento());
                $usuario->setPagamento("pago");
            } else if ($data['acao'] == 'isentar') {
                $pagamento->setIsento(true);
                $pagamento->setValor(0);
                $pagamento->setIdFormaPagamento(1);
                $pagamento->setObs($data["motivo"]);
                $usuario->setPagamento("isento");
            }
            $usuario->save();
            $pagamento->save();
            $this->imprimirEtiqueta($usuario->getNomeSobrenome(), $usuario->getCodigoBarras());
        }

        $this->view->formasPagamento = $formasPagamento;
        $this->view->usuario = $usuario;
    }

    private function imprimirEtiqueta($nome, $codigoBarras) {
        $etiqueta = new Application_Model_Printer_Etiqueta();
        $etiqueta->conectar();
//        $etiqueta->R(0, 0);
//        $etiqueta->N();
//        $etiqueta->Z('B');
//        $etiqueta->Q(122, 16);
//        $etiqueta->A(50, 150, 0, 4, 1, 1, 'N', 'NOME Do usuario Fica AQUI');
//        $etiqueta->B(100, 450, 0, 3, 5, 11, 50, 'B', '12345');
//        $etiqueta->P1(1);
        $texto = $etiqueta->receberTexto();
        $etiqueta->enviarTexto($nome . "\r\n" . $codigoBarras);
        $etiqueta->desconectar();
//        echo $nome . "\r\n" . $codigoBarras;
//        die;
    }

}
