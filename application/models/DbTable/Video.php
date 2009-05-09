<?php
class Model_DbTable_Video extends Zend_Db_Table_Abstract
{
    protected $_name = 'video';
    protected $_dependentTables = array('Model_DbTableVideo_Tag');
    
    public function insert(array $data)
    {
    	if (!isset($data['created_at'])) {
    		$data['created_at'] = date('Y-m-d H:i:s');
    	}
    	
        if (!isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        
    	return parent::insert($data);
    }
    
    public function update(array $data, $where)
    {
        if (!isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        
    	return parent::update($data, $where);
    }
}