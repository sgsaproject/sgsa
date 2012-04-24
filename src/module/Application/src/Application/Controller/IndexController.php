<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class IndexController extends ActionController
{
		
	public function indexAction()
    {
		//$em = $this->getLocator()->get('mongo_dm');
		//var_dump($em);
        return new ViewModel();
    }
}
