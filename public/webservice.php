<?php

// Define path to application directory
defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
        || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/../library'),
            get_include_path(),
        )));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
                APPLICATION_ENV,
                APPLICATION_PATH . '/configs/application.ini'
);

$application->getBootstrap()->bootstrap('db');

if (isset($_GET['wsdl'])) {
    $autodiscover = new Zend_Soap_AutoDiscover();
    $autodiscover->setClass('Application_Model_WebService');
    $autodiscover->setBindingStyle(array('style' => 'rpc'));
    $autodiscover->handle();
} else {
    ini_set("soap.wsdl_cache_enabled", "0");
    $server = new Zend_Soap_Server();
    $server->setOptions(array(
        'soap_version' => SOAP_1_2,
        'actor' => 'http://' .$_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'],
        'encoding' => 'UTF-8'
    ));
    $server->setWsdl('http://' .$_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'].'?wsdl');
    $server->setClass('Application_Model_WebService');
    $server->handle();
}
