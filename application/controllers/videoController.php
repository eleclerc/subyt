<?php

class videoController extends Zend_Controller_Action
{
    public function showAction()
    {
        $videoModel = new Model_Video;
        $tagModel   = new Model_Tag;
        
        $video = $videoModel->getByPK($this->getRequest()->getParam('id'));
        
        $tagsRS = $tagModel->getForVideoId(
            $this->getRequest()->getParam('id')
        );
        
        $tags = array();
        foreach ($tagsRS as $tag) {
            $tags[$tag['category']][] = array(
                'id'   => $tag['id'],
                'tag' => $tag['tag']
            );
        }
        $this->view->tags = $tags;
        
        $this->view->video = $video;
    }
    
    public function listAction()
    {
    	$videoModel = new Model_Video;
    	
    	$this->view->videos = $videoModel->fetchAll();
    }
}