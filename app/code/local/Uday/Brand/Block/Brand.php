<?php

class Uday_Brand_Block_Brand extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBrands()
    {
        $brands = Mage::getModel('brand/brand')->getCollection();
        $brands->addFieldToFilter('status',1);
        $brands->setOrder('sort_order', 'ASC');
        return $brands;
    }

    public function getBrand()
    {
        $brandId = $this->getRequest()->getParam('brand_id');
        $brand = Mage::getModel('brand/brand')->load($brandId);
        return $brand;
    }

    public function getRewriteKey($brand)
    {
        $requestPath = strtolower(str_replace(" ", "-", $brand->getData('name'))).'.html';
        return $requestPath;
    }

    public function getProducts($brand)
    {
        $products = Mage::getModel('catalog/product')->getCollection();
        $products->addAttributeToFilter('brand',$brand->getId());
        return $products;
    }
}