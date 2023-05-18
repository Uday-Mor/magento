<?php
class Uday_Uday_Block_Adminhtml_Uday_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'uday';
        $this->_controller = 'adminhtml_uday';
        $this->_headerText = Mage::helper('uday')->__('New');
         
        $this->_updateButton('save', 'label', Mage::helper('uday')->__('Save'));
        $this->_updateButton('delete', 'label', Mage::helper('uday')->__('Delete'));
        parent::__construct();
         
        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('uday')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
    }
}