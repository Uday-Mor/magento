<?php

class Ccc_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
    protected $_attributes;

    public function _construct()
    {
        $this->_init('vendor/vendor');
    }

    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
}
