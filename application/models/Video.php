<?php

class Model_Video
{
    protected $_table;
    
    public function __construct()
    {
        $this->_table = new Model_DbTable_Video;
    }

    public function getLatest($limit = 5, $published_only = true)
    {
        $db = $this->_table->getAdapter();

        $select = $db->select()
                     ->from($this->_table->info('name'), array('title', 'id'))
                     ->order('title DESC')
                     ->limit($limit);
    
        if ($published_only) {
        	$select->where('published = 1');
        }
                     
        return $db->fetchAll($select);
    }
    
    public function getByPK($id) 
    {
        $video = $this->_table->find($id);
        
        return $video->current()->toArray();
    }
    
    public function getForTag($tag, $published_only = true) 
    {
    	$db = $this->_table->getAdapter();
    	
    	$select = $db->select()
                     ->from(array('v' => $this->_table->info('name')), array('title', 'id'))
    	             ->join(array('t' => 'Tag'), 'v.id=t.video_id', array())
    	             ->where('t.tag = ?', $tag);

    	if ($published_only) {
    		$select->where('v.published = 1');
    	}
    	             
        return $db->fetchAll($select);	
    }
    
    
    public function fetchAll($published_only = true)
    {
        return $this->_table->fetchAll()->toArray();
    }
    
    /**
     * Insert a new video in db from a youtube url
     * 
     * @param $url
     * @return array newly inserted video info
     */
    public function addFromUrl($url)
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
        
        $id = $this->_table->insert($data);
        $data['id'] = $id;
        
        return $data;
    }
}