<?php

class VideoController extends Zend_Controller_Action
{
    public function showAction()
    {
        $videoService = new Service_Video();
        $tagService   = new Service_Tag();
        
        $video = $videoService->getByPK($this->getRequest()->getParam('id'));
        
        if ($video->published != 1) {
        	$this->_redirect('/');
        }
        
        $tags = $tagService->getForVideoId(
            $this->getRequest()->getParam('id')
        );
        
        $this->view->tags = $tags;
        $this->view->video = $video;
    }
    
    public function listAction()
    {
    	$videoService = new Service_Video();
    	
    	$this->view->videos = $videoService->fetchAll();
    }
    
    public function submitAction()
    {
    	if (!$this->getRequest()->isPost()) {
    		$this->_forward('index', 'index');
    	}
    	
    	$videoService = new Service_Video();
    	
    	try {
    	   $video = $videoService->addFromUrl($this->getRequest()->getParam('url'));
    	} catch (Exception $e) {
    		$video = null;
    		$this->view->url = $this->getRequest()->getParam('url');
    		$this->view->error = $e->getMessage();
    	}
        
    	$this->view->video = $video;
    }
}