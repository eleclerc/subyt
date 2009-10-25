<?php
class Service_Tag
{
    /* @var Model_TagMapper */
    protected $_mapper;

    /**
     * Set data mapper
     *
     * @param mixed $mapper
     * @return Model_TagMapper
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * Get data mapper
     *
     * lazy load Model_TagMapper instance if no mapper registered
     *
     * @return Model_TagcMapper
     */
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Model_TagMapper());
        }

        return $this->_mapper;
    }
    
    public function getForVideoId($video_id)
    {
        return $this->getMapper()->getForVideoId($video_id);
    }
    
    public function getForCategory($category)
    {
        return $this->getMapper()->getForCategory($category);
    }
}