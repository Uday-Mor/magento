<?php
class Uday_Uday_Block_Adminhtml_Uday_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('udayAdminhtmlUdayGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('uday/uday')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('id', array(
            'header'    => Mage::helper('uday')->__('Id'),
            'align'     => 'left',
            'index'     => 'id',
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('uday')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('uday')->__('Mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('uday')->__('status'),
            'align'     => 'left',
            'index'     => 'status'
        ));
        
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('uday')->__('Created At'),
            'align'     => 'left',
            'index'     => 'created_at'
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('uday')->__('Updated At'),
            'align'     => 'left',
            'index'     => 'updated_at'
        ));
        
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('uday');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('uday')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('uday')->__('Are you sure?')
        ));
        return $this;
    }
}