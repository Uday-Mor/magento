<?php
class Uday_Brand_Block_Left extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBrands()
    {
        $brands = Mage::getModel('brand/brand')->getCollection();
        $brands->addFieldToFilter('status',1);
        $brands->setOrder('sort_order','ASC');
        return $brands;
    }

    public function getRewriteKey($brand)
    {
        $requestPath = strtolower(str_replace(" ", "-", $brand->getData('name'))).'.html';
        return $requestPath;
    }

    public function getColors()
    {
        $attribute = Mage::getSingleton('eav/config')
            ->getAttribute(Mage_Catalog_Model_Product::ENTITY, 'color');

        if ($attribute->usesSource()) {
            $options = $attribute->getSource()->getAllOptions(false);
        }
        return $options;
    }
}