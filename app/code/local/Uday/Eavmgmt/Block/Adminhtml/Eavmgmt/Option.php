<?php

class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Option extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        
        $this->_blockGroup = 'eavmgmt';
        $this->_controller = 'adminhtml_eavmgmt_option';
        $this->_headerText = Mage::helper('eavmgmt')->__('Manage Eavmgmts Option');

        parent::__construct();
    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('eavmgmt/adminhtml_eavmgmt/' . $action);
    }

}