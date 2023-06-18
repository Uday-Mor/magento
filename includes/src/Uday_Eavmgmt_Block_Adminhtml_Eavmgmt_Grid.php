<?php
class Uday_Eavmgmt_Block_Adminhtml_Eavmgmt_Grid extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();

        $this->addColumn('entity_type_id', array(
            'header'=>Mage::helper('eav')->__('Entity Type Id'),
            'sortable'=>true,
            'index'=>'entity_type_id'
        ));

        $this->addColumn('frontend_input', array(
            'header'    => Mage::helper('eav')->__('Input Type'),
            'align'     => 'left',
            'index'     => 'frontend_input'
        ));

        $this->addColumn('backend_type', array(
            'header'    => Mage::helper('eav')->__('Backend Type'),
            'align'     => 'left',
            'index'     => 'backend_type'
        ));

        $this->addColumn('source_model', array(
            'header'    => Mage::helper('eav')->__('Source Model'),
            'align'     => 'left',
            'index'     => 'source_model'
        ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('eav')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('eav')->__('Show Options'),
                        'url'       => array('base'=> '*/*/option'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

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

        $this->getMassactionBlock()->addItem('exportoptions', array(
             'label'    => Mage::helper('eavmgmt')->__('Export Options'),
             'url'      => $this->getUrl('*/*/massExportOptions'),
        ));
        return $this;
    }

}