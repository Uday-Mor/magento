<?php
class Uday_Eavmgmt_Model_Resource_Eavmgmt_Option_Collection
    extends Mage_Eav_Model_Resource_Entity_Attribute_Collection
{

    protected function _construct()
    {
        $this->_init('eav/entity_attribute_option');
    }

    protected function _initSelect()
    {
        $this->getSelect()
            ->from(array('main_table' => $this->getResource()->getMainTable()));
        return $this;
    }
}