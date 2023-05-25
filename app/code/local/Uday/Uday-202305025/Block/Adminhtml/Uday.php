<?php
class Uday_Uday_Block_Adminhtml_Uday extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'uday';
        $this->_controller = 'adminhtml_uday';
        $this->_headerText = Mage::helper('uday')->__('Manage');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('uday')->__('Add New'));
        } else {
            $this->_removeButton('add');
        }

    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('uday/adminhtml_uday/' . $action);
    }
}
