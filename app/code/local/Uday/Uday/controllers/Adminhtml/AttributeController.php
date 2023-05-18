<?php
/**
 * 
 */
class Uday_Uday_Adminhtml_AttributeController extends Mage_Adminhtml_Controller_Action
{
    protected $_entityTypeId;

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions('delete');
        parent::preDispatch();
        $this->_entityTypeId = Mage::getModel('eav/entity')->setType(Uday_Uday_Model_Uday::ENTITY)->getTypeId();
    }

    protected function _initAction()
    {
        $this->_title($this->__('Uday'))
             ->_title($this->__('Attributes'))
             ->_title($this->__('Manage Attributes'));

        if($this->getRequest()->getParam('popup')) {
            $this->loadLayout('popup');
        } else {
            $this->loadLayout()
                ->_setActiveMenu('uday/attributes')
                ->_addBreadcrumb(Mage::helper('uday')->__('Uday'), Mage::helper('uday')->__('Uday'))
                ->_addBreadcrumb(
                    Mage::helper('uday')->__('Manage Attributes'),
                    Mage::helper('uday')->__('Manage Attributes'))
            ;
        }
        return $this;
    }

	public function indexAction()
	{
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('uday/adminhtml_attribute', 'uday'))
            ->renderLayout();
	}

	public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('attribute_id');
        $model = Mage::getModel('uday/resource_eav_attribute')
            ->setEntityTypeId($this->_entityTypeId);
        if ($id) {
            $model->load($id);

            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('uday')->__('This attribute no longer exists'));
                $this->_redirect('*/*/');
                return;
            }

            // entity type check
            if ($model->getEntityTypeId() != $this->_entityTypeId) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('uday')->__('This attribute cannot be edited.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        // set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getAttributeData(true);
        if (! empty($data)) {
            $model->addData($data);
        }

        Mage::register('uday_attribute', $model);
        // echo "<pre>";
        // print_r($this->getLayout()->createBlock('uday/adminhtml_attribute_edit'));
        // die();
        $this->_initAction();

        $this->_title($id ? $model->getName() : $this->__('New Attribute'));

        $item = $id ? Mage::helper('uday')->__('Edit Product Attribute')
                    : Mage::helper('uday')->__('New Product Attribute');

        $this->_addBreadcrumb($item, $item);
        // $this->getLayout()->createBlock('uday/adminhtml_attribute_edit')->setTemplate('catalog/product/attribute/js.phtml')
        //     ->setIsPopup((bool)$this->getRequest()->getParam('popup'));

        $this->_addContent($this->getLayout()->createBlock('uday/adminhtml_attribute_edit'));

        $this->renderLayout();

    }

	// public function saveAction()
    // {
    //     try {
    //         $model = Mage::getModel('sample/sample');
    //         $addressModel = Mage::getModel('sample/sample_address');
    //         $data = $this->getRequest()->getPost('salesmen');
    //         $addressData = $this->getRequest()->getPost('address');

    //         $sampleId = $this->getRequest()->getParam('id');
    //         if (!$sampleId)
    //         {
    //             $model->setData($data)->setId($this->getRequest()->getParam('sample_id'));
    //         }

    //         $model->setData($data)->setId($this->getRequest()->getParam('id'));
    //         if ($model->getCreatedTime() == NULL || $model->getUpdateTime() == NULL)
    //         {
    //             $model->setCreatedTime(now())->setUpdateTime(now());
    //         } 
    //         else {
    //             $model->setUpdateTime(now());
    //         }

    //         $model->save();
    //         if ($model->save()) {
    //             if ($sampleId) {
    //                 $addressModel->load($sampleId,'sample_id');
    //             }

    //             $addressModel->setData(array_merge($addressModel->getData(),$addressData));
    //             $addressModel->sample_id = $model->sample_id;
    //             $addressModel->save();
    //         }
            
    //         Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sample')->__('sample was successfully saved'));
    //         Mage::getSingleton('adminhtml/session')->setFormData(false);
             
    //         if ($this->getRequest()->getParam('back')) {
    //             $this->_redirect('*/*/edit', array('id' => $model->getId()));
    //             return;
    //         }
    //         $this->_redirect('*/*/');
    //         return;
    //     } catch (Exception $e) {
    //         Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    //         Mage::getSingleton('adminhtml/session')->setFormData($data);
    //         $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('sample_id')));
    //         return;
    //     }

    //     Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sample')->__('Unable to find sample to save'));
    //     $this->_redirect('*/*/');
    // }

    // public function deleteAction()
    // {
    //     if( $this->getRequest()->getParam('sample_id') > 0 ) {
    //         try {
    //             $model = Mage::getModel('sample/sample');
                 
    //             $model->setId($this->getRequest()->getParam('sample_id'))
    //             ->delete();
                 
    //             Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('sample was successfully deleted'));
    //             $this->_redirect('*/*/');
    //         } catch (Exception $e) {
    //             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    //             $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('sample_id')));
    //         }
    //     }
    //     $this->_redirect('*/*/');
    // }

    // public function massDeleteAction()
    // {
    //     $salesmenIds = $this->getRequest()->getParam('sample');
    //     if(!is_array($salesmenIds)) {
    //          Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select sample(s).'));
    //     } else {
    //         try {
    //             $sample = Mage::getModel('sample/sample');
    //             foreach ($salesmenIds as $sampleId) {
    //                 $sample->reset()
    //                     ->load($sampleId)
    //                     ->delete();
    //             }
    //             Mage::getSingleton('adminhtml/session')->addSuccess(
    //                 Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($salesmenIds))
    //             );
    //         } catch (Exception $e) {
    //             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    //         }
    //     }

    //     $this->_redirect('*/*/index');
    // }

    // public function massUpdateAction()
    // {
    //     echo 111;
    //     echo "<pre>";
    //     print_r($_POST);
    // }
}
