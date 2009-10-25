<?php
class Model_TagcategoryMapper 
{
    protected $_dbTable;

    public function __construct()
    {
        $this->_dbTable = new Model_DbTable_Tagcategory();
    }

    public function getDbTable()
    {
        return $this->_dbTable;
    }
    
    public function fetchAll() 
    {
        $results = array();
        foreach ($this->getDbTable()->fetchAll() as $category) {
            $results[] = new Model_Tagcategory($category->toArray());
        }

        return $results;
    }
}
