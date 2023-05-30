<?php

class Uday_Idx_Model_Idx extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('idx/idx');
    }

    public function checkBrand()
    {
        $idxBrandId = $this->getData('brand_id');
        if (!$idxBrandId) {
            return false;
        }
        return true;
    }

    public function checkCollection()
    {
        $idxCollectionId = $this->getData('collection_id');
        if (!$idxCollectionId) {
            return false;
        }
        return true;
    }

    public function updateMainBrand($idxBrandNames)
    {
        $brandCollection = Mage::getModel('brand/brand')->getCollection();
        $brandNames = $brandCollection->getConnection()
            ->fetchPairs($brandCollection->getSelect()->columns(['brand_id','name']));

        $newBrands = array_diff($idxBrandNames, $brandNames);
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('brand');
        $data = [];
        foreach ($newBrands as $id => $name) {
            $row = ['name'=>$name];
            array_push($data, $row);
        }

        $writeConnection->insertMultiple($tableName, $data);
        $newBrandNames = $brandCollection->getConnection()
            ->fetchPairs($brandCollection->getSelect()->columns(['brand_id','name']));
        return $newBrandNames;    
    }

    public function updateMainCollection($idxCollectionNames)
    {
        $collection = Mage::getModel('collection/collection')->getCollection();
        $collectionName = $collection->getConnection()
            ->fetchPairs($collection->getSelect()->columns(['collection_id','name']));

        $newCollectios = array_diff($idxCollectionNames, $collectionName);
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('collection');
        $data = null;
        foreach ($newCollectios as $id => $name) {
            $row = ['name'=>$name];
            array_push($data, $row);
        }
        
        if (!$data) {
            $writeConnection->insertMultiple($tableName, $data);
        }

        $newCollectionNames = $collection->getConnection()
            ->fetchPairs($collection->getSelect()->columns(['collection_id','name']));
        return $newCollectionNames;    
    }

    public function updateMainProduct($idxSkus)
    {

        $productCollection = Mage::getModel('product/product')->getCollection();
        foreach ($productCollection as $product) {
            $productSkus[$product->getData('product_id')] = $product->getData('sku');
        }

        $newProducts = array_diff($idxSkus, $productSkus);
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('product');
        $data = null;
        foreach ($newProducts as $id => $sku) {
            $row = ['sku'=>$sku];
            array_push($data, $row);
        }

        if ($data) {
            $writeConnection->insertMultiple($tableName, $data);
        }
        
        $productCollection = Mage::getModel('product/product')->getCollection();
        foreach ($productCollection as $product) {
            $productSkus[$product->getData('product_id')] = $product->getData('sku');
        }
        return $productSkus;    
    }

}
