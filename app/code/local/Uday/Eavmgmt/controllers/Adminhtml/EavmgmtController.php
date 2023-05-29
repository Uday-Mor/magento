<?php
class Uday_Eavmgmt_Adminhtml_EavmgmtController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
    	$this->_title($this->__('Eavmgmt'))
             ->_title($this->__('Manage Eavmgmts'));
       	$this->loadLayout();
       	$this->_addContent($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt'));
	   	$this->renderLayout();
    }

    public function exportCsvAction()
    {
        $fileName   = 'eav-'.gmdate('YmdHis').'.csv';
        $grid       = $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function massExportAction()
    {
        $attributeIds = $this->getRequest()->getParam('eavmgmt');
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        $collection->addFieldToFilter('attribute_id', array('in' => $attributeIds));
        $fileName   = 'eav-' . gmdate('YmdHis') . '.csv';
        $grid       = $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_csv');
        $grid->setCollection($collection);
        $this->_prepareDownloadResponse($fileName, $grid->getCsv());
    }

    public function massExportOptionsAction()
    {
        $attributeIds = $this->getRequest()->getParam('eavmgmt');
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_option_collection');
        echo "<pre>";
        print_r($collection->getItems());
        die;
        $collection->addFieldToFilter('attribute_id', array('in' => $attributeIds));
        $fileName   = 'eav-' . gmdate('YmdHis') . '.csv';
        $grid       = $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_csv');
        $grid->setCollection($collection);
        $this->_prepareDownloadResponse($fileName, $grid->getCsv());
    }

    public function optionGridAction()
    {
        $this->_title($this->__('Eavmgmt'))
             ->_title($this->__('Manage Eavmgmts Options'));
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_option'));
        $this->renderLayout();
    }
}