<?php

class Uday_Brand_Model_Resource_Brand_Rewrite extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {  
        $this->_init('brand/brand_rewrite', 'rewrite_id');
    }  
}