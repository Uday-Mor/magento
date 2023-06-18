<?php
class Ccc_Practice_Block_Adminhtml_Query_Grid7 extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customer/customer')->getCollection();
        $collection->getSelect()
            ->joinLeft(
                array('o' => Mage::getSingleton('core/resource')->getTableName('sales_flat_order')),
                'e.entity_id = o.customer_id',
                array('order_status_count' => 'COUNT(o.entity_id)')
            )
            ->joinLeft(
                array('s' => Mage::getSingleton('core/resource')->getTableName('sales_order_status')),
                'o.status = s.status',
                array('order_status' => 's.label')
            )
            ->group('e.entity_id');
            // ->group('s.order_status');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array( 
            'header'    => Mage::helper('practice')->__('Customer Id'),
            'align'     => 'left',
            'index'     => 'entity_id',
        ));

        $this->addColumn('firstname', array( 
            'header'    => Mage::helper('practice')->__('First Name'),
            'align'     => 'left',
            'index'     => 'firstname',
        ));

        $this->addColumn('email', array( 
            'header'    => Mage::helper('practice')->__('Email'),
            'align'     => 'left',
            'index'     => 'email',
        ));

        $this->addColumn('order_status', array( 
            'header'    => Mage::helper('practice')->__('Order Status'),
            'align'     => 'left',
            'index'     => 'order_status',
        ));

        $this->addColumn('order_status_count', array( 
            'header'    => Mage::helper('practice')->__('Order Status Count'),
            'align'     => 'left',
            'index'     => 'order_status_count',
        ));
    }
}