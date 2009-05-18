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
        $category = new Model_Tagcategory;
        $this->view->categories = $category->fetchAll();
        
        // Latest video w/ tags info
        $video = new Model_Video;
        $this->view->latest = $video->getLatest();
    }
}

