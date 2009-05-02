<?php
class Model_DbTable_Video extends Zend_Db_Table_Abstract
{
    protected $_name = 'video';
    protected $_dependentTables = array('Model_DbTableVideo_Tag');
}