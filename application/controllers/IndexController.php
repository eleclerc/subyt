<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $category = new Model_Tagcategory;
        $this->view->categories = $category->fetchAll();
        
        $video = new Model_Video;
        $this->view->latest_video = $video->getLatestVideos();

        $tag = new Model_Tag;
        $this->view->latest_tag = $tag->getLatestTags();
    }
}

