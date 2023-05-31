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
        $attribute = Mage::getModel('catalog/resource_eav_attribute')->loadByCode('catalog_product','collection');
        $options = $attribute->getSource()->getAllOptions();
        $existOption = array_filter(array_column($options,'label'));
        $newOptions = array_diff($idxCollectionNames, $existOption);
        if($newOptions){
            foreach ($newOptions as $key => $value) {
                $option['attribute_id'] = $attribute->getId();
                $option['value'] = array(0 => array($value));
                $option['label'] = $value;
                $setup = new Mage_Eav_Model_Entity_Setup('core_setup');
                $setup->addAttributeOption($option);
            }
        }
    }

    public function updateMainProduct($idxSkus)
    {

        $productCollection = Mage::getModel('catalog/product')->getCollection();
        foreach ($productCollection as $product) {
            $productSkus[$product->getData('entity_id')] = $product->getData('sku');
        }

        $newProducts = array_diff($idxSkus, $productSkus);
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('catalog_product_entity');
        foreach ($newProducts as $id => $sku) {
            $row[] = [ 'sku'=>$sku,
                    'type_id'=>'simple',
                    'entity_type_id'=>4,
                    'attribute_set_id'=>4,
                    'created_at'=>now()];
        }

        if ($row) {
            $writeConnection->insertMultiple($tableName, $row);
        }
        
        return true;    
    }

    public function updateBrandId()
    {
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $sourceTableName = $resource->getTableName('brand');
        $destinationTableName = $resource->getTableName('import_product_idx');

        $query = "UPDATE $destinationTableName AS d
                  INNER JOIN $sourceTableName AS s ON d.brand = s.name
                  SET d.brand_id = s.brand_id";
        $connection->query($query);
        return true;
    }

    public function updateCollectionId()
    {
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $sourceTableName = $resource->getTableName('eav_attribute_option_value');
        $destinationTableName = $resource->getTableName('import_product_idx');

        $query = "UPDATE $destinationTableName AS d
                  INNER JOIN $sourceTableName AS s ON d.collection = s.value
                  SET d.collection_id = s.option_id";
        $connection->query($query);
        return true;
    }

    public function updateProductId()
    {
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $sourceTableName = $resource->getTableName('catalog_product_entity');
        $destinationTableName = $resource->getTableName('import_product_idx');

        $query = "UPDATE $destinationTableName AS d
                  INNER JOIN $sourceTableName AS s ON d.sku = s.sku
                  SET d.product_id = s.entity_id";
        $connection->query($query);
        return true;
    }

    public function updateProductData()
    {
        $resource = Mage::getSingleton('core/resource');
        $connection = $resource->getConnection('core_write');
        $sourceTableName = $resource->getTableName('import_product_idx');
        $destinationTableName = $resource->getTableName('cataloginventory_stock_item');

        $query = "INSERT INTO {$destinationTableName} (product_id, qty, stock_id)
                        SELECT product_id, quantity , 1
                        FROM {$sourceTableName}";
        // $connection->query($query);
        $destinationTableName = $resource->getTableName('catalog_product_entity_int');
        $query = "INSERT INTO {$destinationTableName} (entity_type_id, attribute_id, store_id,entity_id,value)
                        SELECT 4 , 98 , 0 , product_id , status
                        FROM {$sourceTableName}";
        $connection->query($query);
        $query = "INSERT INTO {$destinationTableName} (entity_type_id, attribute_id, store_id,entity_id,value)
                        SELECT 4 , 104 , 0 , product_id , 4
                        FROM {$sourceTableName}";
        $connection->query($query);
        return true;
    }
}
