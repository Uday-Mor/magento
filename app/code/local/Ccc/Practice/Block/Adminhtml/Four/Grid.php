<?php
class Ccc_Practice_Block_Adminhtml_Four_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
            'renderer'  =>'ccc_practice_block_adminhtml_four_renderer_image'
        ));

        $this->addColumn('thumbnail', array( 
            'header'    => Mage::helper('practice')->__('Thumbnail'),
            'align'     => 'left',
            'index'     => 'thumbnail',
            'renderer'  =>'Ccc_Practice_Block_Adminhtml_Four_Renderer_Smallimage'
        ));
        
        $this->addColumn('small_image', array( 
            'header'    => Mage::helper('practice')->__('Small Image'),
            'align'     => 'left',
            'index'     => 'small_image',
            'renderer'  =>'Ccc_Practice_Block_Adminhtml_Four_Renderer_Thumbnail'
        ));
        return parent::_prepareColumns();
    }
}