<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initViews() {

        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->title = 'Semana Acadêmica 2011';
        $view->slogan = '';

        $view->doctype('XHTML1_STRICT');
        $view->headTitle($view->title)
                ->setSeparator(' - ');
        $view->headMeta()->appendName('keywords', '')
                ->appendName('description', '')
                ->appendName('robots', 'index, follow')
                ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
                ->appendHttpEquiv('Content-Language', 'pt-BR');

        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $view->jQuery()->setVersion('1.5.2');
        $view->jQuery()->setUiVersion('1.8.12');
        $view->jQuery()->uiEnable();
        $view->jQuery()->Enable();
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    protected function _initCache() {
        $frontendOptions = array(
            'lifetime' => 7200, // cache lifetime of 2 hours
            'automatic_serialization' => true
        );

        $backendOptions = array(
                //'cache_dir' => APPLICATION_PATH. '/../data/cache/' // Directory where to put the cache files
        );

        // getting a Zend_Cache_Core object
        $cache = Zend_Cache::factory('Core', 'Apc', $frontendOptions, $backendOptions);

        Zend_Db_Table::setDefaultMetadataCache($cache);
        Zend_Locale::setCache($cache);
        Zend_Date::setOptions(array('cache' => $cache));

        return $cache;
    }

    public function _initZendMail() {
        $config = array('ssl' => 'tls',
            'port' => 587,
            'auth' => 'login',
            'username' => '',
            'password' => '');
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        Zend_Registry::set('transport', $transport);
    }

    protected function _initPlugins() {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Sistema_Plugins_LoginExpiration());
        $front->registerPlugin(new Sistema_Controller_Plugin_Acl());
        //$front->registerPlugin(new Sistema_Plugins_Security());
    }

    public function _initTranslate() {
        $translator = new Zend_Translate(array(
                    'adapter' => 'array',
                    'content' => '../library/resources/languages',
                    'locale' => 'pt_BR',
                    'scan' => Zend_Translate::LOCALE_DIRECTORY)
        );
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }

    protected function _initZFDebug() {
        if (APPLICATION_ENV == 'development') {
            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->registerNamespace('ZFDebug');

            $options = array(
                'plugins' => array('Variables',
                    'File' => array('base_path' => '/path/to/project'),
                    'Memory',
                    'Time',
                    'Registry',
                    'Exception')
            );

            # Instantiate the database adapter and setup the plugin.
            # Alternatively just add the plugin like above and rely on the autodiscovery feature.
            if ($this->hasPluginResource('db')) {
                $this->bootstrap('db');
                $db = $this->getPluginResource('db')->getDbAdapter();
                $options['plugins']['Database']['adapter'] = $db;
            }

            # Setup the cache plugin
            if ($this->hasResource('cache')) {
                $this->bootstrap('cache');
                $cache = $this->getResource('cache');
                $options['plugins']['Cache']['backend'] = $cache->getBackend();
            }

            $debug = new ZFDebug_Controller_Plugin_Debug($options);

            $this->bootstrap('frontController');
            $frontController = $this->getResource('frontController');
            $frontController->registerPlugin($debug);
        }
    }

}

