<?php
/**
 * 
 */
class Uday_Uday_Model_Observer
{
    public function handleSaveAfter(Varien_Event_Observer $observer)
    {
        Mage::log("Product with ID has been saved.",null,'observer.log');
    }
}