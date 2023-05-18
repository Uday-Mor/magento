<?php
class Uday_Uday_Model_Resource_Eav_Attribute extends Mage_Eav_Model_Entity_Attribute
{
    const SCOPE_STORE                           = 0;
    const SCOPE_GLOBAL                          = 1;
    const SCOPE_WEBSITE                         = 2;

    const MODULE_NAME                           = 'Uday_Uday';
    const ENTITY                                = 'uday_eav_attribute';

    protected $_eventPrefix                     = 'uday_entity_attribute';

    protected $_eventObject                     = 'attribute';

    static protected $_labels                   = null;

    protected function _construct()
    {
        $this->_init('uday/attribute');
    }
}
