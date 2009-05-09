<?php

class tagcategoryController extends Zend_Controller_Action
{
    public function showAction()
    {
        $category = $this->getRequest()->getParam('category');

        $tagModel = new Model_Tag;
        
        $this->view->tags = $tagModel->getForCategory($category);
        $this->view->category = $category;
    }
}