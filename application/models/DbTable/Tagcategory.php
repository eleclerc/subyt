<?php
class Model_DbTable_Tagcategory extends Zend_Db_Table_Abstract
{
    protected $_name = 'tagcategory';
    
    // a Tag have a category
    protected $_referenceMap    = array(
        'Tag' => array(
            'columns'           => 'id',
            'refTableClass'     => 'Tag',
            'refColumns'        => 'tagcategory_id'
        ),
    );
}