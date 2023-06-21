<?php
class Ccc_Practice_Block_Adminhtml_Five_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*');

        $query = $collection->getSelect()->joinLeft(
            array('mg' => $collection->getTable('catalog/product_attribute_media_gallery')),
            'mg.entity_id = e.entity_id',
            array('media_count' => 'COUNT(mg.value_id)')
        )
        ->group('e.entity_id');

        $this->_query = $query;
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array( 
            'header'    => Mage::helper('practice')->__('Attribute Id'),
            'align'     => 'left',
            'index'     => 'entity_id',
        ));

        $this->addColumn('sku', array( 
            'header'    => Mage::helper('practice')->__('Code'),
            'align'     => 'left',
            'index'     => 'sku',
        ));

        $this->addColumn('media_count', array( 
            'header'    => Mage::helper('practice')->__('Media Count'),
            'align'     => 'left',
            'index'     => 'media_count',
        ));
    }
}