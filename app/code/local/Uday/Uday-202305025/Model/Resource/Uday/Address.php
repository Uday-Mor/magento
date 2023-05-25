<?php
class Uday_Uday_Model_Resource_Uday_Address extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('uday/uday_address', 'address_id');
    }
}
