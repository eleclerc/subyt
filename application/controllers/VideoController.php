<?php

class VideoController extends Zend_Controller_Action
{
    public function showAction()
    {
        $videoModel = new Model_Video;
        $tagModel   = new Model_Tag;
        
        $video = $videoModel->getByPK($this->getRequest()->getParam('id'));
        
        if ($video['published'] != 1) {
        	$this->_redirect('/');
        }
        
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
    
    public function submitAction()
    {
    	if (!$this->getRequest()->isPost()) {
    		$this->_forward('index', 'index');
    	}
    	
    	$videoModel = new Model_Video;
    	
    	try {
    	   $video = $videoModel->addFromUrl($this->getRequest()->getParam('url'));
    	} catch (Exception $e) {
    		$video = null;
    		$this->view->url = $this->getRequest()->getParam('url');
    		$this->view->error = $e->getMessage();
    	}
        
    	$this->view->video = $video;
    }
}