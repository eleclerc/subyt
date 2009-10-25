<?php

class TagcategoryController extends Zend_Controller_Action
{
    public function showAction()
    {
        $category = $this->getRequest()->getParam('category');

        $tagService = new Service_Tag();
        
        $this->view->tags = $tagService->getForCategory($category);
        $this->view->category = $category;
    }
}