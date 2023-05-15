<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('vendor_id');
        $this->setDefaultSort('vendor_id');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('vendor_id', array(
            'header'    => Mage::helper('vendor')->__('Vendor Id'),
            'width'     => '50px',
            'index'     => 'vendor_id',
            'type'  => 'number',
        ));

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('vendor')->__('First Name'),
            'index'     => 'first_name'
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('vendor')->__('Last Name'),
            'index'     => 'last_name'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('vendor')->__('Email'),
            'index'     => 'email'
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('vendor')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));

        // $this->getMassactionBlock()->addItem('newsletter_subscribe', array(
        //      'label'    => Mage::helper('vendor')->__('Subscribe to Newsletter'),
        //      'url'      => $this->getUrl('*/*/massSubscribe')
        // ));

        // $this->getMassactionBlock()->addItem('newsletter_unsubscribe', array(
        //      'label'    => Mage::helper('vendor')->__('Unsubscribe from Newsletter'),
        //      'url'      => $this->getUrl('*/*/massUnsubscribe')
        // ));

        // $groups = $this->helper('vendor')->getGroups()->toOptionArray();

        // array_unshift($groups, array('label'=> '', 'value'=> ''));
        // $this->getMassactionBlock()->addItem('assign_group', array(
        //      'label'        => Mage::helper('vendor')->__('Assign a Customer Group'),
        //      'url'          => $this->getUrl('*/*/massAssignGroup'),
        //      'additional'   => array(
        //         'visibility'    => array(
        //              'name'     => 'group',
        //              'type'     => 'select',
        //              'class'    => 'required-entry',
        //              'label'    => Mage::helper('vendor')->__('Group'),
        //              'values'   => $groups
        //          )
        //     )
        // ));

        return $this;
    }
}
