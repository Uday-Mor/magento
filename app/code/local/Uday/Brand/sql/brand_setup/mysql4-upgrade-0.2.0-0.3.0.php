<?php
require_once 'app/Mage.php';
umask(0);
Mage::app();

// Load the CMS page model for the home page
$pageIdentifier = 'home_page';
$page = Mage::getModel('cms/page')->load($pageIdentifier, 'identifier');

if ($page->getId()) {
    // Update the content of the CMS page
    $newContent = '<p>This is the updated content for the home page.</p>';
    $page->setContent($newContent);

    // Save the CMS page
    $page->save();

    echo 'Home page content has been updated successfully.';
} else {
    echo 'Home page not found.';
}