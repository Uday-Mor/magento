<?php
class Ccc_Practice_Block_Adminhtml_One_Grid extends Mage_Adminhtml_Block_Widget_Grid
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

        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->getSelect()
            ->joinLeft(
                array('ov' => 'catalog_product_entity_varchar'),
                'ov.entity_id = e.entity_id AND ov.attribute_id = 73',
                array('name' => 'ov.value')
            )
            ->joinLeft(
                array('a' => 'catalog_product_entity_decimal'),
                'a.entity_id = e.entity_id AND a.attribute_id = 77',
                array('price' => 'a.value')
            )
            ->joinLeft(
                array('b' => 'catalog_product_entity_decimal'),
                'b.entity_id = e.entity_id AND b.attribute_id = 81',
                array('cost' => 'b.value')
            )
            ->joinLeft(
                array('c' => 'catalog_product_entity_int'),
                'c.entity_id = e.entity_id AND c.attribute_id = 94',
                array('color' => 'c.value')
            );

        $collection->getSelect()
            ->reset(Zend_Db_Select::COLUMNS)
            ->columns(array(
                'sku' => 'e.sku',
                'name' => 'ov.value',
                'price' => 'a.value',
                'cost' => 'b.value',
                'color' => 'c.value'
            ));

        $query = $collection->getSelect();
        $this->_query = $query;
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

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