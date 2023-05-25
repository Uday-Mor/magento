<?php
class Ccc_Practice_Adminhtml_SevenController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $mage = new Mage();
        // print_r(get_class_methods($mage));

        // print_r($mage->getVersion());
        // output 1.9.4.5

        // output 
        // print_r($mage->getVersionInfo());
        //Array (
        //     [major] => 1
        //     [minor] => 9
        //     [revision] => 4
        //     [patch] => 5
        //     [stability] => 
        //     [number] => 
        // )

        // print_r($mage->getEdition());
        // output Community

        // print_r($mage->reset());
        // output Set all my static data to defaults

        // print_r($mage->register('mage',$mage));
        // print_r($mage->register('mage',$mage,true));
        // output register object to registry

        // print_r($mage->unregister('mage'));
        // output unset object from registry

        // print_r($mage->registry('mage'));
        // output get object from registry

//1     // print_r($mage->setRoot('C:/xampp/htdocs/2023/magento/app/code'));
        // output Set application root absolute path

        // print_r($mage->getRoot());
        // output get application root absolute path

        // print_r($mage->getEvents());
        // output object of Varien_Event_Collection 

        print_r($mage->objects());
        // output object of Varien_Event_Collection 


    }
}
