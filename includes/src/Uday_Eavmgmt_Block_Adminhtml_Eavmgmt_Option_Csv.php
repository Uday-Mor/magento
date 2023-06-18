<?php
class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Option_Csv extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
	protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addColumn('option_id', array(
            'header' => Mage::helper('eavmgmt')->__('Option ID'),
            'index' => 'option_id',
        ));

        $this->addColumn('value', array(
            'header' => Mage::helper('eavmgmt')->__('Option Name'),
            'index' => 'value',
            'renderer' => 'Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Option_Renderer_Option'
        ));

        $this->addColumn('attribute_code', array(
            'header' => Mage::helper('eavmgmt')->__('Attribute Name'),
            'index' => 'attribute_code',
        ));

        $this->addColumn('sort_order', array(
            'header' => Mage::helper('eavmgmt')->__('Sort Order'),
            'index' => 'sort_order',
        ));
        
        return $this;
    }
}