<?php
class Uday_Uday_Block_Adminhtml_Uday_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        
        $fieldset = $form->addFieldset('sample_form',array('legend'=>Mage::helper('uday')->__('information')));

        $fieldset->addField('first_name', 'text', array(
            'label' => Mage::helper('uday')->__('First Name'),
            'required' => true,
            'name' => 'uday[first_name]',
        ));

        $fieldset->addField('last_name', 'text', array(
            'label' => Mage::helper('uday')->__('Last Name'),
            'required' => false,
            'name' => 'uday[last_name]',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('uday')->__('Email'),
            'required' => true,
            'name' => 'uday[email]',
        ));

        $fieldset->addField('gender', 'select', array(
            'label' => Mage::helper('uday')->__('Gender'),
            'required' => false,
            'name' => 'uday[gender]',
            'values'    => array(
                    'Approved' => 'Approved',
                    'Denied'   => 'Denied'
                )
        ));

        // $fieldset->addField(
        //     'gender',
        //     'select',
        //     array(
        //         'id'    => 'lazadaCategory',
        //         'label'  => Mage::helper('test_sellercenter')->__('Category '),
        //         'name'   => 'status',
        //         'values' => Mage::helper('test_sellercenter/dropdown')->getLazadaCategories(),
        //         'class' => 'required-entry',
        //     )
        // );

        $fieldset->addField('mobile', 'text', array(
            'label' => Mage::helper('uday')->__('Mobile'),
            'required' => false,
            'name' => 'uday[mobile]',
        ));

        $fieldset->addField('status', 'text', array(
            'label' => Mage::helper('uday')->__('Status'),
            'required' => false,
            'name' => 'uday[status]',
        ));
        
        if(Mage::getSingleton('adminhtml/session')->getSampleData())
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSampleData());
            Mage::getSingleton('adminhtml/session')->setSampleData(null);
        } 
        elseif (Mage::registry('uday_data')) 
        {
            $form->setValues(Mage::registry('uday_data')->getData());
        }
        return parent::_prepareForm();
    }
}