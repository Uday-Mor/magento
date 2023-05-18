<?php
class Uday_Uday_Block_Adminhtml_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_attribute';
        $this->_blockGroup = 'uday';
        $this->_headerText = Mage::helper('uday')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('uday')->__('Add New Attribute');
        parent::__construct();
    }

}
