<?php
class UM_Vendor_AccountController extends Mage_Core_Controller_Front_Action
{
    protected function _getSession()
    {
        return Mage::getSingleton('core/session');
    }

    public function createAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function createpostAction()
    {
        try {
            $model = Mage::getModel('vendor/vendor');
            $vendorData = $this->getRequest()->getPost('vendor');
            if ($model->load($vendorData['email'],'email')->getId()) {
                throw new Exception("Vendor already exists", 1);
            }

            $model->setData($vendorData)->setCreatedTime(now())->setStatus(0);
            $model->password = md5($model->password);
            if (!$model->save()) {
                throw new Exception("Error : Vendor is not registered", 1);
            }
            $model->sendVerificationMail();
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/login');
        }
        $this->_redirect('*/*/login');
    }

    public function loginAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function loginPostAction()
    {
        try {
            $session = $this->_getSession();
            $loginCredentials = $this->getRequest()->getPost('login');
            if (!empty($loginCredentials['username']) && !empty($loginCredentials['password'])) {
                $model = Mage::getModel('vendor/vendor')->load($loginCredentials['username'],'email');
                if (!$model->getId()) {
                    throw new Exception("Wrong email or password !!!", 1);
                }

                try {
                    if ($model->getStatus() != 1) {
                        throw new Exception("Email is not verified", 1);
                    }
                } catch (Exception $e) {
                    $value = Mage::helper('vendor')->getEmailConfirmationUrl($loginCredentials['username']);
                    $message = Mage::helper('vendor')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
                    $session->addError($message);
                    $this->_redirect('*/*/login');
                    return;
                }

                if ($model->getPassword() != md5($loginCredentials['password'])) {
                    throw new Exception("Wrong email or password !!!", 1);
                }
            }else{
                throw new Exception("Please Enter email and password !!!", 1);
            }
        } catch (Exception $e) {
            $session->addError($e->getMessage());
            $this->_redirect('*/*/login');
            return;
        }
    }

    public function confirmationAction()
    {
        $vendor = Mage::getModel('vendor/vendor');

        // try to confirm by email
        $email = $this->getRequest()->getPost('email');
        if ($email) {
            try {
                $vendor->load($email,'email');
                if (!$vendor->getId()) {
                    throw new Exception('');
                }
                if ($vendor->getStatus() != 1) {
                    $vendor->sendVerificationMail();
                    $this->_getSession()->addSuccess($this->__('Please, check your email for confirmation key.'));
                } else {
                    $this->_getSession()->addSuccess($this->__('This email does not require confirmation.'));
                }
                $this->_getSession()->setUsername($email);
                $this->_redirect('*/*/login');
            } catch (Exception $e) {
                $this->_getSession()->addException($e, $this->__('Wrong email.'));
                $this->_redirect('*/*/*');
            }
            return;
        }

        // output form
        $this->loadLayout();
        $this->renderLayout();
    }

    public function confirmAction()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            $key = $this->getRequest()->getParam('key');
            $encryptionKey = 'cybercom';
            $vendorId = openssl_decrypt(base64_decode($key), 'AES-256-CBC', $encryptionKey, 0, substr(md5($encryptionKey), 0, 16));
            echo "<pre>";
            print_r($vendorId);
            die;
        } catch (Exception $e) {
            
        }
    }
}
