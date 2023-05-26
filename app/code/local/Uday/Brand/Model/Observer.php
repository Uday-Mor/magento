<?php

class Uday_Brand_Model_Observer
{
    public function prepareCatalogForm($observer)
    {
        $form = $observer->getEvent()->getForm();
        $fieldset = $form->addFieldset('group_fields' . 4, array(
            'legend' => Mage::helper('catalog')->__('General'),
            'class' => 'fieldset-wide'
        ));
        $collection = Mage::getModel('brand/brand')->getCollection()->getItems();
        foreach($collection as $c){
            $options[$c->brand_id] = $c->name ; 
        }
        $fieldset->addField('brand_id', 'select', array(
        'label' => Mage::helper('brand')->__('Brand'),
        'required' => false,
        'name' => 'brand_id',
        'values'=> $options,
        ));
    }
}
