<?php
class Model_Tag
{
    protected $_table;
    
    public function __construct()
    {
        $this->_table = new Model_DbTable_Tag;
    }
    
    public function getLatest($limit=5)
    {
        $db = $this->_table->getAdapter();
        
        $select = $db->select()
                     ->from($this->_table->info('name'), array('tag'))
                     ->join('tagcategory', 'tagcategory_id=tagcategory.id', 'tagcategory.category')
                     ->order('created_at DESC')
                     ->limit($limit);
        
        return $db->fetchAll($select);
    }
    
    public function getForVideoId($video_id)
    {
        $db = $this->_table->getAdapter();
        
        $tags = array();
        $select = $db->select()
                     ->from('tag', array('tag', 'id'))
                     ->from('tagcategory', 'category')
                     ->where('tagcategory.id=tag.tagcategory_id')
                     ->where('tag.video_id = ?', $video_id);
        $rows = $db->fetchAll($select);
        
        return $rows;
    }
    
    public function getForCategory($category) 
    {
        $db = $this->_table->getAdapter();
        
        $select = $db->select()
                     ->from(array('t' => $this->_table->info('name')), array('tag'))
                     ->join(array('c' => 'Tagcategory'), 'c.id=t.tagcategory_id', array())
                     ->where('c.category = ?', $category)
                     ->distinct();
                            
        return $db->fetchAll($select);  
    }
}