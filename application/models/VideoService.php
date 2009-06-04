<?php

class Model_VideoService
{
    /* @var Model_VideoMapper */
    protected $_mapper;

    /**
     * Set data mapper
     *
     * @param mixed $mapper
     * @return Model_VideoMapper
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * Get data mapper
     *
     * lazy load Model_VideoMapper instance if no mapper registered
     *
     * @return Model_VideoMapper
     */
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Model_VideoMapper());
        }

        return $this->_mapper;
    }

    /**
     * Get the latest videos, with their tags
     *
     * @param int $limit amount of videos to return
     * @param bool $published_only return published_only or all video
     *
     * @return array of Model_Video
     */
    public function getLatest($limit = 5, $published_only = true)
    {
        return $this->getMapper()->getLatest($limit, $published_only);
    }

    /**
     * Get a single video by it's pk
     *
     * @param int $id
     * @return Model_Video
     */
    public function getByPK($id)
    {
        return $this->getMapper()->find($id);
    }

    /**
     * Get all the videos for a tag
     *
     * @param string $tag
     * @param bool $published_only
     * @return array of Model_Video
     */
    public function getForTag($tag, $published_only = true)
    {
        return $this->getMapper()->getForTag($tag, $published_only);
    }

    /**
     * Get all videos
     *
     * @param bool $published_only
     * @return array of Model_Video
     */
    public function fetchAll($published_only = true)
    {
        return $this->getMapper()->fetchAll($published_only);
    }

    /**
     * get a video from youtube and save it too
     *
     * @param $url
     * @return array newly inserted video info
     */
    public function addFromUrl($url)
    {
        $video = $this->getMapper()->getFromYoutube($url);

        $id = $this->getMapper()->insert($video);
        $video->id = $id;

        return $video->toArray();
    }
}