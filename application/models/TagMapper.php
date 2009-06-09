<?php
class Model_TagMapper
{
    protected $_dbTable;
    
    public function __construct()
    {
        $this->_dbTable = new Model_DbTable_Tag;
    }

    public function getDbTable()
    {
        return $this->_dbTable;
    }
    
    public function getForVideoId($video_id)
    {
        $db = $this->getDbTable()->getAdapter();
        
        $tags = array();
        $select = $db->select()
                     ->from('tag', array('tag', 'id'))
                     ->from('tagcategory', 'category')
                     ->where('tagcategory.id=tag.tagcategory_id')
                     ->where('tag.video_id = ?', $video_id);
        $rows = $db->fetchAll($select);
        
        foreach ($rows as $tag) {
            if ($tag['category'] == 'dancer') {
                $tags['dancer'][] = $tag['tag'];
            } else {
                $tags[$tag['category']] = $tag['tag'];
            }
        }
            
        return $tags;
    }
    
    public function getForCategory($category) 
    {
        $db = $this->getDbTable()->getAdapter();
        
        $select = $db->select()
                     ->from(array('t' => $this->getDbTable()->info('name')), array('tag'))
                     ->join(array('c' => 'Tagcategory'), 'c.id=t.tagcategory_id', array())
                     ->where('c.category = ?', $category)
                     ->distinct();
        $results = array();
        foreach ($db->fetchAll($select) as $row) {
            $results[] = new Model_Tag($row);
        }
        
        return $results;
    }
}