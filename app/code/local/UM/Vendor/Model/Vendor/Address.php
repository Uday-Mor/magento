<?php

class UM_Vendor_Model_Vendor_Address extends Mage_Core_Model_Abstract
{
    function __construct()
    {
        $this->_init('vendor/vendor_address');
    }

    public function getCountryOptions()
    {
        $countryOptions = Mage::getModel('directory/country')->getResourceCollection()
            ->loadByStore()
            ->toOptionArray();
        return $countryOptions;
    }
}
