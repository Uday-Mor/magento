<?php

class UM_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('vendor_form',array('legend'=>Mage::helper('vendor')->__('Vendor Information')));

        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('vendor')->__('First Name'),
            'required' => true,
            'name' => 'vendor[first_name]',
        ));

        $fieldset->addField('last_name','text', array(
            'label' => Mage::helper('vendor')->__('Last Name'),
            'required' => true,
            'name' => 'vendor[last_name]'
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('vendor')->__('Email'),
            'required' => true,
            'name' => 'vendor[email]',
        ));

        $newFieldset = $form->addFieldset(
            'password_fieldset',
            array('legend'=>Mage::helper('customer')->__('Password Management'))
        );
        $field = $newFieldset->addField('password', 'password',
            array(
                'label' => Mage::helper('customer')->__('Password'),
                'class' => 'input-text required-entry validate-password min-pass-length-' . 10,
                'name'  => 'password',
                'required' => true,
                'note' => Mage::helper('adminhtml')
                    ->__('Password must be at least of %d characters.', 10),
            )
        );
        $field->setRenderer($this->getLayout()->createBlock('adminhtml/customer_edit_renderer_newpass'));

        $fieldset->addField('gender', 'radios', array(
            'label' => Mage::helper('vendor')->__('Gender'),
            'required' => false,
            'name' => 'vendor[gender]',
            'values' => array(
                array('value' => 1, 'label' => 'Male'),
                array('value' => 2, 'label' => 'Female'),
                array('value' => 3, 'label' => 'Other'),
            ),
            'value' => 1,
        ));

        $fieldset->addField('mobile','text', array(
            'label' => Mage::helper('vendor')->__('Mobile'),
            'required' => true,
            'name' => 'vendor[mobile]'
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('vendor')->__('Status'),
            'required' => false,
            'name' => 'vendor[status]',
            'options' => array(1=>'Active',2=>'Inactive'),
        ));

        if ( Mage::getSingleton('adminhtml/session')->getVendorData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getVendorData());
            Mage::getSingleton('adminhtml/session')->setVendorData(null);
        } elseif ( Mage::registry('vendor_edit') ) {
            $form->setValues(Mage::registry('vendor_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    