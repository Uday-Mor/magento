<?php

class UM_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{

    const XML_PATH_REMIND_EMAIL_TEMPLATE = 'customer/password/remind_email_template';
    const XML_PATH_FORGOT_EMAIL_IDENTITY = 'customer/password/forgot_email_identity';
    function __construct()
    {
        $this->_init('vendor/vendor');
    }

    public function sendPasswordReminderEmail()
    {
        $email = $this->getEmail();
        $vars = array(
            'vendor' => $this,
            'message' => 'Hello vendor, hope you have a good day!',
        );

        $emailTemplate = Mage::getModel('core/email_template')->loadDefault('vendor_welcome_email_template');
        $processedTemplate = $emailTemplate->getProcessedTemplate($vars);
        $this->sendMail($email,$processedTemplate);
    }

    public function sendVerificationMail()
    {   
        $email = $this->getEmail();
        $encryptionKey = 'cybercom';
        $hashKey = base64_encode(openssl_encrypt(rand(1,10000).'vendor'.$this->getId(), 'AES-256-CBC', $encryptionKey, 0, substr(md5($encryptionKey), 0, 16)));
        $vars = array(
            'vendor' => $this,
            'message' => 'Hello vendor, hope you have a good day!',
            'key' => $hashKey,
        );

        $emailTemplate = Mage::getModel('core/email_template')->loadDefault('vendor_verification_email_template');
        $processedTemplate = $emailTemplate->getProcessedTemplate($vars);
        $this->sendMail($email,$processedTemplate);
    }

    public function sendMail($email,$processedTemplate)
    {
        $config = array(
            'ssl' => 'tls',
            'port' => 587,
            'auth' => 'login',
            'username' => 'udaykumar.m.cybercom@gmail.com',
            'password' => 'zeinecuqumsuxlja',
        );
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        $mail = new Zend_Mail('UTF-8');
        $mail->setBodyHtml($processedTemplate);
        $mail->setfrom('udaykumar.m.cybercom@gmail.com', 'uday');
        $mail->addTo($email, 'Vendor');
        $mail->setSubject('Welcome Vendor');
        $mail->setBodyText('Hello vendor, hope you have a good day!');
        $mail->send($transport);
    }
}
