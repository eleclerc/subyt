<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Autoload default stuff (Api_, Form_, Model_, Model_DbTable, Plugin_)
     * */
    protected function _initAutoload()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array( 
            'namespace' => '', 
            'basePath'  => APPLICATION_PATH)); 

        return $moduleLoader; 
    }
    
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_TRANSITIONAL');
    }

    /**
     * Initialize the ZFDebug Bar
     */
    protected function _initZFDebug()
    {
        $zfdebugConfig = $this->getOption('zfdebug');

        if ($zfdebugConfig['enabled'] != 1) {
            return;
        }

        require_once 'ZFDebug/Controller/Plugin/Debug.php';

        // Ensure DB instance is present, and fetch it
        $this->bootstrap('Db');
        $db = $this->getResource('Db');

        $options = array(
            'database_adapter' => $db,
            'handle_errors' => true,
            'jquery_path' => '/js/jquery-1.3.2.min.js');
        $zfdebugBar = new ZFDebug_Controller_Plugin_Debug($options);

        // Ensure front controller instance is present, and fetch it
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');

        $front->registerPlugin($zfdebugBar);
    }
}

