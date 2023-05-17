<?php
class Ccc_Practice_Adminhtml_OneController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $collection = Mage::getModel('product/product')->getCollection();
        // print_r($collection);

        $read = Mage::getSingleton('core/resource')->getConnection('core_write');

        // $select = $read->select()->from('product',array('sku','cost'));
        $collection->addFieldToFilter('status', array('eq' => 1));
        
        // print_r($collection->getItems());
        // print_r($read->fetchAll($select));
        die;
    }
}
