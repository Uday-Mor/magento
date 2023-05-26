<?php
class Uday_Brand_Model_Resource_Brand_Address extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('brand/brand_address' ,'address_id');
    }
}