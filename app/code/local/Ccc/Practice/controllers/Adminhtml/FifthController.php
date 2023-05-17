<?php
class Ccc_Practice_Adminhtml_FifthController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        // create an instance of the collection class for the table you want to query
        $collection = Mage::getModel('product/product')->getCollection();

        // add filters to the collection as needed
        $collection->addFieldToFilter('status', array('eq' => 2));

        // fetch the records as an array
        $recordsArray = $collection->getData();
        print_r($recordsArray);

        // fetch the records as an object
        $recordsObject = $collection->getItems();
        print_r($recordsObject);
    }
}
