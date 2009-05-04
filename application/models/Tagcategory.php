<?php 
class Model_Tagcategory
{
    protected $_table;
    
    public function __construct()
    {
        $this->_table = new Model_DbTable_Tagcategory;
    }
    
    public function fetchAll() 
    {
        return $this->_table->fetchAll()->toArray();
    }
}