<?php
class Ccc_Practice_Adminhtml_ThirdController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";
        $product = Mage::getModel('product/product');
        // print_r($product->getDataModel());
        $data = array(
            'sku' => 'HP 1300',
            'cost' => 1500,
            'price' => 2000,
        );
        $row = $product->setData($data);
        print_r($row->save());
        die;
    }
}
