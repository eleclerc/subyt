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
        $categoryService = new Model_TagcategoryService;
        $this->view->categories = $categoryService->fetchAll();
        
        // Latest video w/ tags info
        $videoService = new Model_VideoService();
        $this->view->latest = $videoService->getLatest();
    }
}

