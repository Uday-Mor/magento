<?php

class Uday_Uday_Block_Adminhtml_Uday_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('uday_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('uday')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label'     => Mage::helper('uday')->__('Properties'),
            'title'     => Mage::helper('uday')->__('Properties'),
            'content'   => $this->getLayout()->createBlock('uday/adminhtml_uday_attribute_edit_tab_main')->toHtml(),
            'active'    => true
        ));

        $model = Mage::registry('entity_attribute');

        $this->addTab('labels', array(
            'label'     => Mage::helper('uday')->__('Manage Label / Options'),
            'title'     => Mage::helper('uday')->__('Manage Label / Options'),
            'content'   => $this->getLayout()->createBlock('uday/adminhtml_uday_attribute_edit_tab_options')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}