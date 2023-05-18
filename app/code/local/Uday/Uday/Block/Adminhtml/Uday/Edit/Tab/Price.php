<?php
class Uday_Uday_Block_Adminhtml_Uday_Edit_Tab_Price extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('udayAdminhtmludayGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('uday/uday_price')->getCollection();
        $collection->getSelect()
                    ->joinRight(
                                array('p' =>'product'),
                                'p.product_id = main_table.product_id'
                            );
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('name', array(
            'header'    => Mage::helper('product')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('uday')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('uday')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('uday')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('s_price', array(
            'header'    => Mage::helper('uday')->__('Sample Price'),
            'align'     => 'left',
            'index'     => 's_price',
            'type'      => 'input'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('sample_id');
        $this->getMassactionBlock()->setFormFieldName('sample');

        $this->getMassactionBlock()->addItem('update', array(
             'label'    => Mage::helper('uday')->__('Update Price'),
             'url'      => $this->getUrl('*/*/massUpdate'),
             'confirm'  => Mage::helper('uday')->__('Are you sure?')
        ));
        return $this;
    }
}