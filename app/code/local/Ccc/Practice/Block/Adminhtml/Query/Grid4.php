<?php
class Ccc_Practice_Block_Adminhtml_Query_Grid4 extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
    }

    protected function _prepareCollection()
    {
        $productCollection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect(array('sku', 'image', 'thumbnail', 'small_image'));
        $this->setCollection($productCollection);
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

        $this->addColumn('image', array( 
            'header'    => Mage::helper('practice')->__('Image'),
            'align'     => 'left',
            'index'     => 'image',
        ));

        $this->addColumn('thumbnail', array( 
            'header'    => Mage::helper('practice')->__('Thumbnail'),
            'align'     => 'left',
            'index'     => 'thumbnail',
        ));
        
        $this->addColumn('small_image', array( 
            'header'    => Mage::helper('practice')->__('Small Image'),
            'align'     => 'left',
            'index'     => 'small_image',
        ));
        return parent::_prepareColumns();
    }
}