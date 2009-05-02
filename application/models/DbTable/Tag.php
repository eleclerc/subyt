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
}