<?php

class Model_Video
{
    protected $_table;
    
    public function __construct()
    {
        $this->_table = new Model_DbTable_Video;
    }

    public function getLatest($limit = 5)
    {
        $db = $this->_table->getAdapter();

        $select = $db->select()
                     ->from($this->_table->info('name'), array('title', 'id'))
                     ->order('title DESC')
                     ->limit($limit);

        return $db->fetchAll($select);
    }
    
    public function getByPK($id) 
    {
        $video = $this->_table->find($id);
        
        return $video->current()->toArray();
    }
    
    public function getForTag($tag) 
    {
    	$db = $this->_table->getAdapter();
    	
    	$select = $db->select()
                     ->from(array('v' => $this->_table->info('name')), array('title', 'id'))
    	             ->join(array('t' => 'Tag'), 'v.id=t.video_id')
    	             ->where('t.tag = ?', $tag);
    	                 	
        return $db->fetchAll($select);	
    }
    
    
    public function fetchAll()
    {
        return $this->_table->fetchAll()->toArray();
    }
    
}