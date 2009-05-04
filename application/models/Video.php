<?php

class Model_Video
{
    protected $_table;
    
    public function __construct()
    {
        $this->_table = new Model_DbTable_Video;
    }

    public function getLatestVideos($limit = 5)
    {
        $db = $this->_table->getAdapter();

        $select = $db->select()
                     ->from($this->_table->info('name'), array('title', 'id'))
                     ->order('title DESC')
                     ->limit($limit);

        return $db->fetchAll($select);
    }
    
    public function find($id) {
        $video = $this->_table->find($id);
        
        return $video->current()->toArray();
    }
}