<?php
class Ccc_Practice_Adminhtml_SecondController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('product');
        $query = "INSERT INTO {$tableName} (sku, price, cost) VALUES ('HP 1200', '1200', '1100')";
        print_r($writeConnection->query($query));
        die;
    }
}
