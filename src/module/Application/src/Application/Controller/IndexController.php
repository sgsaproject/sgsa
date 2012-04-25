<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    Application\Model\Document\User;

class IndexController extends ActionController
{

    public function indexAction()
    {
        $dm = $this->getLocator()->get('mongo_dm');
        //var_dump($em);

        $user = new User();
        $user->setName('Bulat S.');

        // tell Doctrine 2 to save $user on the next flush()
        $dm->persist($user);
        $dm->flush();

        return new ViewModel();
    }

}
