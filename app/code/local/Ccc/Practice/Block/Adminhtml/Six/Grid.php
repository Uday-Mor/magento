<?php
class Ccc_Practice_Block_Adminhtml_Six_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public $_query = null;

    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
        $this->_prepareCollection();
    }

    protected function _prepareCollection()
    {
        $customerCollection = Mage::getModel('customer/customer')->getCollection();
        $customerCollection->addAttributeToSelect(array('entity_id', 'firstname', 'lastname', 'email'));
        $query = $customerCollection->getSelect()->joinLeft(
            array('o' => Mage::getSingleton('core/resource')->getTableName('sales/order')),
            'o.customer_id = e.entity_id',
            array('order_count' => 'COUNT(o.entity_id)')
        )
        ->group('e.entity_id');
        $this->_query = $query;
        $this->setCollection($customerCollection);
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

        $this->addColumn('order_count', array( 
            'header'    => Mage::helper('practice')->__('Order Count'),
            'align'     => 'left',
            'index'     => 'order_count',
        ));
    }
}