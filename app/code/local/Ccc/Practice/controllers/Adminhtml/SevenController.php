<?php
class Ccc_Practice_Adminhtml_SevenController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $adapter = Mage::getSingleton('core/resource')->getConnection('core_read');
        print_r($adapter->getColumnDefinitionFromDescribe('product','product_id'));
        print_r(get_class_methods($adapter));
    }
}
