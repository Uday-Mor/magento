<?php

class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Option extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'eavmgmt';
        $this->setId('eavmgmtAdminhtmleavmgmtGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
       
        $id = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('eav/entity_attribute_option')->getCollection();
        $collection->getSelect()
                    ->join('eav_attribute', 'main_table.attribute_id = eav_attribute.attribute_id', 'attribute_code')
                    ->where('main_table.attribute_id = ?',$id);
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
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

        return parent::_prepareColumns();
    }
    
}