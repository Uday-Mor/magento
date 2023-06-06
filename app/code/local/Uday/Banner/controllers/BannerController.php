<?php
class Uday_Banner_BannerController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
       	$this->loadLayout();
       	// $banner = $this->getLayout()->createBlock('banner/banner');
        // $this->getLayout()->getBlock('content')->append($banner,'banner');
	   	$this->renderLayout();
    }
}