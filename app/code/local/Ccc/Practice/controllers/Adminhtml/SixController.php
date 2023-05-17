<?php
class Ccc_Practice_Adminhtml_SixController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        // create an instance of the SQL SELECT class
        $select = Mage::getSingleton('core/resource')->getConnection('core_read')->select();
        // define the query using the SQL SELECT class methods
        $select->from('product', array('sku', 'cost', 'price'))
               ->limit(10);

        // execute the query and fetch the records as an array
        $recordsArray = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($select);

        // execute the query and fetch the records as an object
        $recordsObject = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchAll($select, array(), Zend_Db::FETCH_OBJ);
        print_r($recordsObject);
    }
}
