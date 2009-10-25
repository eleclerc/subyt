<?php

class TagController extends Zend_Controller_Action
{
    public function showAction()
    {
        $tag = $this->getRequest()->getParam('tag');
        
        $videoService = new Service_Video();

        $this->view->videos = $videoService->getForTag($tag);
        $this->view->tag = $tag;
    }
}