<?php
class Service_Tagcategory
{
    /* @var Model_TagcategoryMapper */
    protected $_mapper;

    /**
     * Set data mapper
     *
     * @param mixed $mapper
     * @return Model_TagcategoryMapper
     */
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }

    /**
     * Get data mapper
     *
     * lazy load Model_TagcategoryMapper instance if no mapper registered
     *
     * @return Model_TagcategoryMapper
     */
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Model_TagcategoryMapper());
        }

        return $this->_mapper;
    }
    
    public function fetchAll() 
    {
        return $this->getMapper()->fetchAll();
    }
}