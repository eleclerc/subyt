<?php

class Model_Video
{
    protected $_id;
    protected $_url;
    protected $_youtube_id;
    protected $_title;
    protected $_published;
    protected $_created_at;
    protected $_updated_at;
    protected $_tags;

    /* @var Model_VideoMapper */
    protected $_mapper;

    /**
     * Constructor
     *
     * @param array|null $options options to set object state
     * @return void
     */
    public function __construct(array $options = array())
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set data mapper
     *
     * @param mixed $mapper
     * @return Model_Video
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * Get data mapper
     *
     * lazy load Model_Video instance if no mapper registered
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
     * Getter
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        $local = '_' . $name;
        if (property_exists($this, $local)) {
            return $this->$local;
        }

        return null;
    }

    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
           $this->$method($value);
        }

        $local = '_' . $name;
        if (!property_exists($this, $local)) {
            throw new InvalidArgumentException();
        }

        $this->$local = $value;
    }

    /**
     * Set object state
     *
     * @param array $options
     * @return Model_Video
     */
    public function setOptions($options)
    {
        foreach ($options as $option => $value) {
            $this->$option = $value;
        }

        return $this;
    }

    public function toArray()
    {
        return array(
            'id'            => $this->_id,
            'url'           => $this->_url,
            'youtube_id'    => $this->_youtube_id,
            'title'         => $this->_title,
            'published'     => $this->_published,
            'created_at'    => $this->_created_at,
            'updated_at'    => $this->_updated_at,
            'tags'          => $this->_tags);
    }
}