<?php
class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Csv extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
	protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addColumn('entity_type_id', array(
        	'header'=>Mage::helper('eav')->__('entity_type_id'),
            'index'=>'entity_type_id',
        ));

        $this->addColumn('attribute_id', array(
        	'header'=>Mage::helper('eav')->__('attribute_id'),
            'index'=>'attribute_id'
        ));

        $this->addColumn('attribute_code', array(
        	'header'=>Mage::helper('eav')->__('attribute_code'),
            'index'=>'attribute_code'
        ));

        $this->addColumn('attribute_lable', array(
        	'header'=>Mage::helper('eav')->__('attribute_lable'),
            'index'=>'attribute_lable'
        ));

        $this->addColumn('frontend_input', array(
        	'header'=>Mage::helper('eav')->__('frontend_input'),
            'index'=>'frontend_input'
        ));

        $this->addColumn('backend_model', array(
        	'header'=>Mage::helper('eav')->__('backend_model'),
            'index'=>'backend_model'
        ));

        $this->addColumn('source_model', array(
        	'header'=>Mage::helper('eav')->__('source_model'),
            'index'=>'source_model'
        ));
        
        return $this;
    }
}