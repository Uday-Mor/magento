<?php
class Ccc_Practice_Block_Adminhtml_Three_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public $_query = null;

    public function __construct()
    {
        parent::__construct();
        $this->setId('queryAdminhtmlQueryGrid');
        $this->_prepareCollection();
    }

    protected function _prepareCollection()
    {




        $_data = array();
        $row = ['attribute_code'=>'code1','lable'=>'Code1','option'=>'option1'];
        $row2 = ['attribute_code'=>'code1','lable'=>'Code1','option'=>'option2'];
        $row3 = ['attribute_code'=>'code1','lable'=>'Code1','option'=>'option3'];
        if(!array_key_exists($row["attribute_code"], $_data))
        {
            $_data[$row["attribute_code"]] = array();
        }
        if(!array_key_exists($row2["attribute_code"], $_data))
        {
            $_data[$row2["attribute_code"]] = array();
        }
        if(!array_key_exists($row3["attribute_code"], $_data))
        {
            $_data[$row3["attribute_code"]] = array();
        }
        $_data[$row["attribute_code"]][] = $row["option"];
        $_data[$row2["attribute_code"]][] = $row2["option"];
        $_data[$row3["attribute_code"]][] = $row3["option"];

        echo "<pre>";
        print_r($_data);
        die;



        $attributeCollection = Mage::getModel('eav/entity_attribute')->getCollection();
        $query = $attributeCollection->getSelect()->joinLeft(
            array('option_count_table' => $attributeCollection->getTable('eav/attribute_option')),
            'option_count_table.attribute_id = main_table.attribute_id',
            array('option_count' => 'COUNT(option_count_table.option_id)')
        )
        ->group('main_table.attribute_id')
        ->having('COUNT(option_count_table.option_id) > ?', 1);

        $this->_query = $query;
        $this->setCollection($attributeCollection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('attribute_id', array( 
            'header'    => Mage::helper('practice')->__('Attribute Id'),
            'align'     => 'left',
            'index'     => 'attribute_id',
        ));

        $this->addColumn('attribute_code', array( 
            'header'    => Mage::helper('practice')->__('Code'),
            'align'     => 'left',
            'index'     => 'attribute_code',
        ));

        $this->addColumn('option_count', array( 
            'header'    => Mage::helper('practice')->__('Option Count'),
            'align'     => 'left',
            'index'     => 'option_count',
        ));
        return parent::_prepareColumns();
    }
}