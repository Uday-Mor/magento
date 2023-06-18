<?php
class Ccc_Practice_Block_Adminhtml_Query_Grid2 extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
    }

    protected function _prepareCollection()
    {
        // $collection = Mage::getModel('salesman/salesman')->getCollection();

        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('name')
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('cost')
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('color');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array( 
            'header'    => Mage::helper('practice')->__('Product id'),
            'align'     => 'left',
            'index'     => 'entity_id',
        ));

        $this->addColumn('name', array( 
            'header'    => Mage::helper('practice')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('sku', array(  
            'header'    => Mage::helper('practice')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('cost', array( 
            'header'    => Mage::helper('practice')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('price', array(    
            'header'    => Mage::helper('practice')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('color', array(    
            'header'    => Mage::helper('practice')->__('Color'),
            'align'     => 'left',
            'index'     => 'color'
        ));
        return parent::_prepareColumns();
    }
}