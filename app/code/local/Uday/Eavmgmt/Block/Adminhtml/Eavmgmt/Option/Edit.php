<?php
class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Option_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'eavmgmt';
        $this->_controller = 'adminhtml_eavmgmt_option';
        $this->_headerText = Mage::helper('eavmgmt')->__('Manage Eavmgmts');
    }
}
