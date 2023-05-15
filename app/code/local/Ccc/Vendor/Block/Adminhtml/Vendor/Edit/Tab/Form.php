<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor information')));

        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('vendor')->__('Name'),
            'required' => true,
            'name' => 'vendor[first_name]',
        ));

        $fieldset->addField('last_name', 'text', array(
            'label' => Mage::helper('vendor')->__('Last Name'),
            'required' => false,
            'name' => 'vendor[last_name]',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('vendor')->__('Email'),
            'required' => true,
            'name' => 'vendor[email]',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getVendorData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getVendorData());
            Mage::getSingleton('adminhtml/session')->setVendorData(null);
        } elseif ( Mage::registry('vendor_data') ) {
            $form->setValues(Mage::registry('vendor_data')->getData());
        }
        return parent::_prepareForm();


    }

}





    