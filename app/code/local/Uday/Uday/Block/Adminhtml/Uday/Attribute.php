<?php

class Uday_Uday_Block_Adminhtml_Uday_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = 'uday';
		$this->_controller = 'adminhtml_uday_attribute';
		$this->_headerText = Mage::helper('vendor')->__('Manage Attributes');
        $this->_addButtonLabel = Mage::helper('vendor')->__('Add New Attribute');
		parent::__construct();
	}
}