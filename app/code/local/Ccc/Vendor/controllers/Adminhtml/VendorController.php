<?php

class Ccc_Vendor_Adminhtml_VendorController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        
        $this->_title($this->__('Vendors'))->_title($this->__('Manage Vendors'));
        $this->loadLayout();
        $this->_addContent(
            $this->getLayout()->createBlock('vendor/adminhtml_vendor', 'vendor')
        );
        $this->renderLayout();
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('vendor/vendor')
            ->_addBreadcrumb(Mage::helper('vendor')->__('VENDOR'), Mage::helper('vendor')->__('VENDOR'))
            ->_addBreadcrumb(Mage::helper('vendor')->__('Manage Vendor'), Mage::helper('vendor')->__('Manage Vendor'))
        ;
        return $this;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('vendor/vendor')->load($id);
        $addressModel = Mage::getModel('vendor/vendor_address')->load($id,'vendor_id');
        if ($model->getId() || $id == 0)
        {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data))
            {
                $model->setData($data);
            }
            Mage::register('vendor_data', $model);
            Mage::register('address_data', $addressModel);

            $this->loadLayout();
            $this->_setActiveMenu('vendor/vendor');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Vendor Manager'), Mage::helper('adminhtml')->__('Vendor Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Vendor News'), Mage::helper('adminhtml')->__('Vendor News'));
             
            $this->_addContent($this->getLayout()->createBlock(' vendor/adminhtml_vendor_edit'))
                    ->_addLeft($this->getLayout()
                    ->createBlock('vendor/adminhtml_vendor_edit_tabs'));
            $this->renderLayout();
        }else{
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Vendor does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {
            $model = Mage::getModel('vendor/vendor');
            $addressModel = Mage::getModel('vendor/vendor_address');
            $addressData = $this->getRequest()->getPost('address');
            $data = $this->getRequest()->getPost('vendor');
            $vendorId = $this->getRequest()->getParam('id');
            if (!$vendorId)
            {
                $vendorId = $this->getRequest()->getParam('vendor_id');
            }

            $model->setData($data)->setId($vendorId);
            if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }

            $model->save();
            if ($model->save()) {
                if ($vendorId) {
                    $addressModel->load($vendorId,'vendor_id');
                }

                $addressModel->setData(array_merge($addressModel->getData(),$addressData));
                $addressModel->vendor_id = $model->vendor_id;
                $addressModel->save();
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Unable to find vendor to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('vendor/vendor');
                 
                $model->setId($this->getRequest()->getParam('id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Vendor was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $vendorsIds = $this->getRequest()->getParam('vendor');
        if(!is_array($vendorsIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select vendor(s).'));
        } else {
            try {
                $vendor = Mage::getModel('vendor/vendor');
                foreach ($vendorsIds as $vendorId) {
                    $vendor->reset()
                        ->load($vendorId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($vendorsIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}
