<?php

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * ZFDebug Zend Additions
 *
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2011 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 * @version    $Id$
 */

/**
 * @category   ZFDebug
 * @package    ZFDebug_Controller
 * @subpackage Plugins
 * @copyright  Copyright (c) 2008-2011 ZF Debug Bar Team (http://code.google.com/p/zfdebug)
 * @license    http://code.google.com/p/zfdebug/wiki/License     New BSD License
 */
class ZFDebug_Controller_Plugin_Debug_Plugin_Doctrine2 extends ZFDebug_Controller_Plugin_Debug_Plugin implements ZFDebug_Controller_Plugin_Debug_Plugin_Interface {

    /**
     * Contains plugin identifier name
     *
     * @var string
     */
    protected $_identifier = 'doctrine2';

    /**
     * Contains entityManagers
     * @var array
     */
    protected $_dm;
    
    protected $_queries = array();

    /**
     * Create ZFDebug_Controller_Plugin_Debug_Plugin_Variables
     *
     * @param array $options 
     * @return void
     */
    public function __construct(array $options = array()) {
        if (isset($options['dm'])) {
            $this->_dm = $options['dm'][0];
        }
        if (($this->_dm instanceof Doctrine\ODM\MongoDB\DocumentManager) == false) {
            return 'No DocumentManager';
        }
        $this->_dm->getConnection()->getConfiguration()->setLoggerCallable(function(array $log) {
                    $this->_queries[] = var_export($log, true);
                });
    }

    /**
     * Gets icon
     * @return string
     */
    public function getIconData() {
        return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAidJREFUeNqUk9tLFHEUxz+/mdnZnV1Tt5ttWVC+pBG+9RAYRNBDICT5D1hgL/VQWRAVEfVoCGURhCBFEj6IRkRFF7BAxPZlIbvZBTQq0q677u5c9tdvZyPaS1QHZh7OnPM93/me8xWC4rAnR6WbuAdSYjRvwWzaVFpSFEZpwvvwGnu4GwJB5OwMfwutNKHXrQFrASJcjTM+RPJMh/wvALOpRVh7+pC6gahegjMxQvLsTvnPAHkN5NxbhB5AfptDy4OMD5PsrQwiRElz5uoJvKdjaMsb0FesxX3yEBGsQiY/YWxopWpvv/gjg8zgSXJvEojapVid5wl3DRLc3qWYfCz8ztgQqf6DsiJA5vZFmZuKIyI1kPyC9zJOvjLYuh9zx2Hk5/doNXU4Dwawpx7JMgA3cVe9VT4YRl/djHOnDzd+vQDSdgiz7QAy9RUcG29ytPwOcrPTiEX1RI7fQqhJeDbSdRVmTn30CLUfhfnvZEdOI7PpChoYAVWo5rmOz0R6XoER4ueTx/IKsv8m/S8G+sp1OK8ukzq1DS1cS85OY+3qwWhs8W8ic+UIzv1LSqMoWjRWziCwsV1dkQWKnjf9WIm3z2/OR1Y12zcvqHWG0RbG0GIN5QDm+s3C3LrbXxmBECK6rLCdgWN+M5a6hew8oc7eIoOJUqulr/VI+8Y5pJP2p+VmnkEogrZ4FaGO7jJ3ikpezV+k93wC790L31R6faNPu5K1fwgwAMKf1kgHZKePAAAAAElFTkSuQmCC';
    }

    /**
     * Gets identifier for this plugin
     *
     * @return string
     */
    public function getIdentifier() {
        return $this->_identifier;
    }

    /**
     * Gets menu tab for the Debugbar
     *
     * @return string
     */
    public function getTab() {
        //var_dump($this->_dm);die;
        if (($this->_dm instanceof Doctrine\ODM\MongoDB\DocumentManager) == false) {
            return 'No documentmanager available';
        }
        return 'Doctrine MongoDB ODM';

//        $adapterInfo = array();
//        foreach ($this->_dm as $dm) {
//            if ($logger = $dm->getConnection()->getConfiguration()->getSqlLogger()) {
//                $totalTime = 0;
//                foreach ($logger->queries as $query) {
//                    $totalTime += $query['executionMS'];
//                }
//                $adapterInfo[] = count($logger->queries) . ' in ' . round($totalTime * 1000, 2) . ' ms';
//            }
//        }
//        $html = implode(' / ', $adapterInfo);
        //$html = implode('</br>', $queries);
        return $html;
    }

    /**
     * Gets content panel for the Debug bar
     *
     * @return string
     */
    public function getPanel() {
        if (($this->_dm instanceof Doctrine\ODM\MongoDB\DocumentManager) == false) {
            return '';
        }

        $html = '<h4>Doctrine2 queries - Doctrine2 (Common v' . Doctrine\Common\Version::VERSION .
                //' | DBAL v' . Doctrine\DBAL\Version::VERSION .
                ' | Mongo ODM v' . Doctrine\ODM\MongoDB\Version::VERSION .
                ')</h4>';

//        $queries = array();
//        $this->_dm->getConnection()->getConfiguration()->setLoggerCallable(function(array $log) {
//
//                    $queries[] = var_export($log, true);
//                });

        $html .= implode('</br>', $this->_queries);
        return $html;
    }

}