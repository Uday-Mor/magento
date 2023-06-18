<?php

class Ccc_Practice_Model_Practice extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('practice/practice','entity_id');
    }
}
