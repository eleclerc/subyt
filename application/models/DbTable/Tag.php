<?php
class Model_DbTable_Tag extends Zend_Db_Table_Abstract
{
    protected $_name = 'tag';
    
    protected $_dependentTables = array('Tagcategory');
    
    protected $_referenceMap    = array(
        'Video' => array(
            'columns'           => 'video_id',
            'refTableClass'     => 'Video',
            'refColumns'        => 'id'
        ),
    );
    
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