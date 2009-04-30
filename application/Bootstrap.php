<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView()
    {
        // Initialise view
        $view = new Zend_View();
        $view->doctype('XHTML1_TRANSITIONAL');
        $view->headTitle('SubYT');
        $view->headLink()->appendStylesheet('/css/main.css');
        
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);

        // Return it, so that it can be stored by the bootstrap
        return $view;
    }

    /**
     * Initialize the Scienta ZF Debug Bar
     */
    protected function _initScienta()
    {
        $scConfig = $this->getOption('scienta');

        if ($scConfig['enabled'] != 1) {
            return;
        }

        require_once 'Scienta/Controller/Plugin/Debug.php';

        // Ensure DB instance is present, and fetch it
        $this->bootstrap('Db');
        $db = $this->getResource('Db');

        $options = array('database_adapter' => $db);
        $scBar = new Scienta_Controller_Plugin_Debug($options);

        // Ensure front controller instance is present, and fetch it
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');

        $front->registerPlugin($scBar);
    }
}

