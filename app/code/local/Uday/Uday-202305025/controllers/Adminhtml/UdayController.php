<?php
/**
 * 
 */
class Uday_Uday_Adminhtml_UdayController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('uday/uday')
            ->_addBreadcrumb(Mage::helper('uday')->__('Uday'), Mage::helper('uday')->__('Uday'))
            ->_addBreadcrumb(Mage::helper('uday')->__('Manage Salesmen'), Mage::helper('uday')->__('Manage'))
        ;
        return $this;
    }

	public function indexAction()
	{
		$this->_title($this->__('Sample'))
             ->_title($this->__('Manage'));

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('uday/adminhtml_uday', 'uday'));
        $this->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('uday/uday')->load($id);
        $addressModel = Mage::getModel('uday/uday_address')->load($id,'id');
        if ($model->getId() || $id == 0)
        {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data))
            {
                $model->setData($data);
            }
            Mage::register('uday_data', $model);
            Mage::register('address_data', $addressModel);

            $this->loadLayout();
            $this->_setActiveMenu('uday/uday');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Manager'), Mage::helper('adminhtml')->__('Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('News'), Mage::helper('adminhtml')->__('News'));
             
            $this->_addContent($this->getLayout()->createBlock(' uday/adminhtml_uday_edit'))
                    ->_addLeft($this->getLayout()
                    ->createBlock('uday/adminhtml_uday_edit_tabs'));
            $this->renderLayout();
        }else{
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('uday')->__('Sample does not exist'));
            $this->_redirect('*/*/');
        }
    }
	public function saveAction()
    {
        try {
            $model = Mage::getModel('uday/uday');
            // $addressModel = Mage::getModel('sample/sample_address');
            $data = $this->getRequest()->getPost('uday');
            // $addressData = $this->getRequest()->getPost('address');

            $sampleId = $this->getRequest()->getParam('id');
            if (!$sampleId)
            {
                $model->setData($data)->setId($this->getRequest()->getParam('sample_id'));
            }

            $model->setData($data)->setId($this->getRequest()->getParam('id'));
            if ($model->getCreatedTime() == NULL || $model->getUpdateTime() == NULL)
            {
                $model->setCreatedTime(now())->setUpdateTime(now());
            } 
            else {
                $model->setUpdateTime(now());
            }


            echo "<pre>";
            print_r($model);
            die;

            $model->save();
            if ($model->save()) {
                if ($sampleId) {
                    $addressModel->load($sampleId,'id');
                }

                $addressModel->setData(array_merge($addressModel->getData(),$addressData));
                $addressModel->sample_id = $model->sample_id;
                $addressModel->save();
            }
            
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('uday')->__('sample was successfully saved'));
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
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('sample_id')));
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sample')->__('Unable to find sample to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('sample_id') > 0 ) {
            try {
                $model = Mage::getModel('sample/sample');
                 
                $model->setId($this->getRequest()->getParam('sample_id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('sample was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('sample_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $salesmenIds = $this->getRequest()->getParam('sample');
        if(!is_array($salesmenIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select sample(s).'));
        } else {
            try {
                $sample = Mage::getModel('sample/sample');
                foreach ($salesmenIds as $sampleId) {
                    $sample->reset()
                        ->load($sampleId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($salesmenIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    public function massUpdateAction()
    {
        echo 111;
        echo "<pre>";
        print_r($_POST);
    }
}
