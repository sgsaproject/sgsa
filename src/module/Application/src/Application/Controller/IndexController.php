<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Application\Model\Document\User,
    Application\Model\Document\Instituicao,
    Application\Model\Document\Campus,
    Application\Model\Document\Curso,
    Application\Model\Document\Evento,
    Application\Model\Document\Local;

class IndexController extends ActionController
{

    public function indexAction()
    {
        $dm = $this->getLocator()->get('mongo_dm');

        //$instituicao = new Instituicao();
        //$instituicao->setNome('UNIPAMPA');
//        $campusAlegrete = new Campus();
//        $campusAlegrete->setNome('CTAlegrete');
//        $campusItaqui = new Campus();
//        $campusItaqui->setNome('Itaqui');
//
//        $instituicao->setCampi(array($campusItaqui, $campusItaqui));
//
//        $dm->persist($campusAlegrete);
//        $dm->persist($campusItaqui);
        //$dm->persist($instituicao);
        //$dm->flush();
        //var_dump($instituicao);
        $instituicao2 = $dm->getRepository('\Application\Model\Document\Instituicao')->findOneByNome('UNIPAMPA');
        var_dump($instituicao2);

        return new ViewModel();
    }

}
