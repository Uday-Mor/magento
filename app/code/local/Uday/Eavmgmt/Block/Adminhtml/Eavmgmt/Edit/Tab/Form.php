<?php

class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('eavmgmt_form',array('legend'=>Mage::helper('eavmgmt')->__('Eavmgmt Information')));

        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('eavmgmt')->__('First Name'),
            'required' => true,
            'name' => 'eavmgmt[first_name]',
        ));

        $fieldset->addField('last_name','text', array(
            'label' => Mage::helper('eavmgmt')->__('Last Name'),
            'required' => true,
            'name' => 'eavmgmt[last_name]'
        ));

        $fieldset->addField('mobile','text', array(
            'label' => Mage::helper('eavmgmt')->__('Mobile'),
            'required' => true,
            'name' => 'eavmgmt[mobile]'
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('eavmgmt')->__('Email'),
            'required' => true,
            'name' => 'eavmgmt[email]',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getEavmgmtData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getEavmgmtData());
            Mage::getSingleton('adminhtml/session')->setEavmgmtData(null);
        } elseif ( Mage::registry('eavmgmt_edit') ) {
            $form->setValues(Mage::registry('eavmgmt_edit')->getData());
        }
        return parent::_prepareForm();


    }

}





    