<?php 

class Uday_Uday_Adminhtml_UdayController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction(){
		$this->loadLayout();
		$this->_setActiveMenu('uday');
		$this->_title('Uday Grid');
		$this->_addContent($this->getLayout()->createBlock('uday/adminhtml_uday'));
		$this->renderLayout();
	}

	protected function _initUday()
    {
        $this->_title($this->__('Uday'))
            ->_title($this->__('Manage Udays'));

        $udayId = (int) $this->getRequest()->getParam('id');
        $uday   = Mage::getModel('uday/uday')
            ->setStoreId($this->getRequest()->getParam('store', 0))
            ->load($udayId);

        if (!$udayId) {
            if ($setId = (int) $this->getRequest()->getParam('set')) {
                $uday->setAttributeSetId($setId);
            }
        }

        Mage::register('current_uday', $uday);
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));
        return $uday;
    }

	public function newAction(){
		$this->_forward('edit');
	}

	public function editAction(){ 
		$udayId = (int) $this->getRequest()->getParam('id');
        $uday   = $this->_initUday();
        
        if ($udayId && !$uday->getId()) {
            $this->_getSession()->addError(Mage::helper('uday')->__('This uday no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title($uday->getName());

        $this->loadLayout();

        $this->_setActiveMenu('uday/uday');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->renderLayout();
	}

	public function saveAction()
    {
        try {
            $setId = (int) $this->getRequest()->getParam('set');
            $udayData = $this->getRequest()->getPost('account');            
            $uday = Mage::getSingleton('uday/uday');
            $uday->setAttributeSetId($setId);

            if ($udayId = $this->getRequest()->getParam('id')) {
                if (!$uday->load($udayId)) {
                    throw new Exception("No Row Found");
                }
                Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
            }
            
            $uday->addData($udayData);

            $uday->save();

            Mage::getSingleton('core/session')->addSuccess("uday data added.");
            $this->_redirect('*/*/');

        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction()
    {
        try {

            $udayModel = Mage::getModel('uday/uday');

            if (!($udayId = (int) $this->getRequest()->getParam('id')))
                throw new Exception('Id not found');

            if (!$udayModel->load($udayId)) {
                throw new Exception('uday does not exist');
            }

            if (!$udayModel->delete()) {
                throw new Exception('Error in delete record', 1);
            }

            Mage::getSingleton('core/session')->addSuccess($this->__('The uday has been deleted.'));

        } catch (Exception $e) {
            Mage::logException($e);
            $Mage::getSingleton('core/session')->addError($e->getMessage());
        }
        
        $this->_redirect('*/*/');
    }
}