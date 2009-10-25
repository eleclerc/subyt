<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	// List of available categories
        $categoryService = new Service_Tagcategory();
        $this->view->categories = $categoryService->fetchAll();
        
        // Latest video w/ tags info
        $videoService = new Service_Video();
        $this->view->latest = $videoService->getLatest();
    }
}

