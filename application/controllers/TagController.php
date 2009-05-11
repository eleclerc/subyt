<?php

class TagController extends Zend_Controller_Action
{
    public function showAction()
    {
        $tag = $this->getRequest()->getParam('tag');
        
        $videoModel = new Model_Video;

        $this->view->videos = $videoModel->getForTag($tag);
        $this->view->tag = $tag;
    }
}