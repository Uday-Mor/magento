<?php
class Uday_Brand_Model_Resource_Brand_Address_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('brand/brand_address');
    }
}