<?php

class Uday_Uday_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Uday_Uday';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('uday/attribute');
    }
}