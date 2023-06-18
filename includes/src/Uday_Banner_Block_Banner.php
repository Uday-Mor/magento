<?php
class Uday_Banner_Block_Banner extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getGroupBanners()
    {
        $groupId = Mage::getStoreConfig('banner/banner/bannergroup');
        $collection = Mage::getModel('banner/banner')->getCollection();
        $collection->addFieldToFilter('group_id', $groupId);
        $collection->addFieldToFilter('status',1);
        $collection->setOrder('position', 'ASC');
        return $collection;
    }
}