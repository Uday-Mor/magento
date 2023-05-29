<?php
class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Option_Grid extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_option_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        return $this;
    }
        
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('eavmgmt');

        $this->getMassactionBlock()->addItem('export', array(
             'label'    => Mage::helper('eavmgmt')->__('Export'),
             'url'      => $this->getUrl('*/*/massExport'),
        ));
        return $this;
    }

}