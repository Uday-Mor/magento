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
}