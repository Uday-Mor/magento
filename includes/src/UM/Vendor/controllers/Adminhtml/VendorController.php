<?php
class UM_Vendor_Adminhtml_VendorController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
    	$this->_title($this->__('Vendor'))
             ->_title($this->__('Manage Vendors'));
       	$this->loadLayout();
       	$this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor'));
	   	$this->renderLayout();
    }

    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('vendor/vendor')
            ->_addBreadcrumb(Mage::helper('vendor')->__('Vendor Manager'), Mage::helper('vendor')->__('Vendor Manager'))
            ->_addBreadcrumb(Mage::helper('vendor')->__('Manage vendor'), Mage::helper('vendor')->__('Manage vendor'))
        ;
        return $this;
    }
    

    public function editAction()
    {
        $this->_title($this->__('Vendor'))
             ->_title($this->__('Vendors'))
             ->_title($this->__('Edit Vendors'));

        $id = $this->getRequest()->getParam('vendor_id');
        $model = Mage::getModel('vendor/vendor');
        $addressModel = Mage::getModel('vendor/vendor_address');

        if ($id) {
            $model->load($id);
            $addressModel->load($id,'vendor_id');
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vendor')->__('This page no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Vendor'));
        $this->_title($addressModel->getId() ? $addressModel->getTitle() : $this->__('New Vendor Address'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('vendor_edit',$model);
        Mage::register('address_edit',$addressModel);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('vendor')->__('Edit Vendor')
                    : Mage::helper('vendor')->__('New Vendor'),
                $id ? Mage::helper('vendor')->__('Edit Vendor')
                    : Mage::helper('vendor')->__('New Vendor'));

        $this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit'))
                ->_addLeft($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit_tabs'));

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('vendor/vendor');
            $addressModel = Mage::getModel('vendor/vendor_address');
            $addressData = $this->getRequest()->getPost('address');
            $data = $this->getRequest()->getPost('vendor');
            $vendorId = $this->getRequest()->getParam('id');
            if (!$vendorId) {
                $vendorId = $this->getRequest()->getParam('vendor_id');
            }

            $model->setData($data)->setId($vendorId);
            if ($model->getCreatedTime() == NULL) {
                $model->setCreatedTime(now());
            }else{
                $model->setUpdateTime(now());
            }

            $password = $this->getRequest()->getPost('password');
            if ($password == 'auto') {
                $password = Mage::helper('vendor')->generatePassword(10);
            }

            if ($model->password != $password) {
                $model->password = md5($password); 
            }

            if ($model->save()) {
                if ($vendorId) {
                    $addressModel->load($vendorId,'vendor_id');
                }

                $addressModel->setData(array_merge($addressModel->getData(),$addressData));
                $addressModel->vendor_id = $model->vendor_id;
                $addressModel->country = $this->getRequest()->getPost('country');
                if (!$addressModel->save()) {
                    throw new Exception("Address not saved", 1);
                }

                $model->sendPasswordReminderEmail();
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('vendor')->__('Vendor was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setFormData(false);
             
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('vendor_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Unable to find vendor to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('vendor_id') > 0 ) {
            try {
                $model = Mage::getModel('vendor/vendor');
                 
                $model->setId($this->getRequest()->getParam('vendor_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Vendor was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('vendor_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $vendorIds = $this->getRequest()->getParam('vendor');
        if(!is_array($vendorIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select vendor(s).'));
        } else {
            try {
                $vendor = Mage::getModel('vendor/vendor');
                foreach ($vendorIds as $vendorId) {
                    $vendor->load($vendorId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($vendorIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    public function statesAction()
    {
        $countryCode = $this->getRequest()->getPost('country_id');

        $regionCollection = Mage::getModel('directory/region')->getResourceCollection();
        $regionCollection->addCountryFilter($countryCode);
        $regionCollection->load();

        $regions = $regionCollection->toOptionArray();


        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(json_encode($regions));      
    }

    public function massStatusAction()
    {
        $vendorIds = $this->getRequest()->getParam('vendor');
        $status = $this->getRequest()->getParam('status');

        try {
            foreach ($vendorIds as $vendorId) {
                $vendor = Mage::getModel('vendor/vendor')->load($vendorId);
                $vendor->setStatus($status);
                $vendor->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('vendor')->__('Status has been updated for %s vendor(s).', count($vendorIds))
            );
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('vendor')->__('An error occurred while updating the status: %s', $e->getMessage())
            );
        }

        $this->_redirect('*/*/index');
    }
}