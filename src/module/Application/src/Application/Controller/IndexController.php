<?php

namespace Application\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;
	Application\Document\User;

class IndexController extends ActionController
{
		
	public function indexAction()
    {
		//$config = new \Doctrine\ODM\MongoDB\Configuration();
		//$config->setProxyDir('Application/Document/Proxies');
		//$config->setProxyNamespace('Proxies');

		//$reader = new \Doctrine\Common\Annotations\AnnotationReader();
		//$reader->setDefaultAnnotationNamespace('Doctrine\ODM\MongoDB\Mapping\\');
		//$config->setMetadataDriverImpl(new \Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver($reader, __DIR__ . '/Documents'));

		//$dm = \Doctrine\ODM\MongoDB\DocumentManager::create(new Mongo(), $config);
		
		
		//$em = $this->getLocator()->get('mongo_dm');
		// create user
		$user = new User();
		$user->setName('Bulat S.');
		//$user->setEmail('email@example.com');
		$em->persist($user);
		$em->flush();
		//var_dump($em);
        return new ViewModel();
    }
}
