<?php

class Model_VideoMapper
{
    protected $_dbTable;
    
    public function __construct()
    {
        $this->_dbTable = new Model_DbTable_Video;
    }

    public function getDbTable()
    {
    	return $this->_dbTable;
    }
    
    public function getLatest($limit = 5, $published_only = true)
    {
        $db = $this->getDbTable()->getAdapter();
        $tagModel   = new Model_Tag;
        
        $select = $db->select()
                     ->from($this->getDbTable()->info('name'), array('title', 'id'))
                     ->order('title DESC')
                     ->limit($limit);
    
        if ($published_only) {
            $select->where('published = 1');
        }
        
        $rows = $db->fetchAll($select);
        
        // fetch the tags for each video
        foreach ($rows as &$video) {
	        $video['tags'] = $tagModel->getForVideoId($video['id']);
        }

        $results = array();
        foreach ($rows as $row) {
        	$results[] = new Model_Video($row);
        }
        
        return $results;
    }
    
    public function getByPK($id) 
    {
        $video = $this->getDbTable()->find($id);
        
        return new Model_Video($video->current()->toArray());
    }
    
    public function getForTag($tag, $published_only = true) 
    {
        $db = $this->getDbTable()->getAdapter();
        
        $select = $db->select()
                     ->from(array('v' => $this->getDbTable()->info('name')), array('title', 'id'))
                     ->join(array('t' => 'Tag'), 'v.id=t.video_id', array())
                     ->where('t.tag = ?', $tag);

        if ($published_only) {
            $select->where('v.published = 1');
        }
                     
        return $db->fetchAll($select);  
    }
    
    
    public function fetchAll($published_only = true)
    {
        $results = array();
        foreach ($this->getDbTable()->fetchAll() as $video) {
            $results[] = new Model_Video($video->toArray());
        }
        
        return $results;
    }
    
    /**
     * get a new video from from a youtube url
     * 
     * @param $url
     * @return Model_Video video object
     */
    public function getFromYoutube($url)
    {
        $urlArray = parse_url($url);
        if (!isset($urlArray['query'])) {
            throw new Exception('Invalid URL');
        }
        
        parse_str($urlArray['query'], $query);

        if (!isset($query['v'])) {
            throw new Exception('Invalide YouTube Video URL');
        }
        
        $youtube_id = $query['v'];
                
        $yt = new Zend_Gdata_YouTube();
        try {
            $videoEntry = $yt->getVideoEntry($youtube_id);
        } catch (Zend_Gdata_App_HttpException $e) {
            //YouTube may be down too?
            throw new Exception('Invalid YouTube Video URL');    
        }   
        
        $data = array(
            'url' => $url,
            'youtube_id' => $youtube_id,
            'title' => $videoEntry->getTitleValue(),
        );

        return new Model_Video($data);
    }
    
    public function insert(Model_Video $video) 
    {
        //we don't deal with tags now
        $data = $video->toArray();
        unset($data['tags']);

        return $this->getDbTable()->insert($data);    	
    }
    
    public function find($id)
    {   
    	$resultSet = $this->getDbTable()->find($id);
    	
    	return $resultSet->current()->toArray();
    }
}