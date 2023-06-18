<?php
class Ccc_Practice_Block_Adminhtml_Query_Grid8 extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
    }

    protected function _prepareCollection()
    {
        $products = Mage::getModel('catalog/product')->getCollection();
        $products->getSelect()
            ->joinLeft(
                array('oi' => Mage::getSingleton('core/resource')->getTableName('sales/order_item')),
                'e.entity_id = oi.product_id',
                array('sold_quantity' => 'SUM(oi.qty_ordered)')
            )
            ->group('e.entity_id');
        $this->setCollection($products);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array( 
            'header'    => Mage::helper('practice')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'entity_id',
        ));

        $this->addColumn('sku', array( 
            'header'    => Mage::helper('practice')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku',
        ));

        $this->addColumn('sold_quantity', array( 
            'header'    => Mage::helper('practice')->__('Sold Quantity'),
            'align'     => 'left',
            'index'     => 'sold_quantity',
        ));
    }
}