<?php
class Model_Tag
{
    protected $_table;
    
    public function __construct()
    {
        $this->_table = new Model_DbTable_Tag;
    }
    
    public function getLatestTags($limit=5)
    {
        $db = $this->_table->getAdapter();
        
        $select = $db->select()
                     ->from($this->_table->info('name'), array('name', 'id'))
                     ->join('tagcategory', 'tagcategory_id=tagcategory.id', 'tagcategory.category')
                     ->order('created_at DESC')
                     ->limit($limit);
        
        return $db->fetchAll($select);
    }
    
    public function getTagsForVideoId($video_id)
    {
        $db = $this->_table->getAdapter();
        
        $tags = array();
        $select = $db->select()
                     ->from('tag', array('id', 'name'))
                     ->from('tagcategory', 'category')
                     ->where('tagcategory.id=tag.tagcategory_id')
                     ->where('tag.video_id = ?', $video_id);
        $rows = $db->fetchAll($select);
        
        return $rows;
    }
}