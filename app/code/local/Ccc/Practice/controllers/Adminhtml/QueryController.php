<?php
class Ccc_Practice_Adminhtml_QueryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        // echo "<pre>";
        // $resource = Mage::getSingleton('core/resource');
        // $write = $resource->getConnection('core_write');
        // $table = $resource->getTableName('product/product');
        // $table2 = $resource->getTableName('idx/idx');

        // $write->insert(
        //     $table, 
        //     ['sku' => 'ABCD', 'cost' => 200]
        // );

        // echo $select = $write->select()
        //     ->from(['tbl' => $table], ['product_id', 'sku'])
        //     ->joinLeft(['tbl2' => $table2], 'tbl.product_id = tbl2.product_id', ['sku']);   
            // ->group('cost')
            // ->where('name LIKE ?', "%{$name}%")
        // $results = $write->fetchAll($select);

        // $write->update(
        //     $table,
        //     ['sku' => 'ABCSD', 'cost' => 5000],
        //     ['product_id = ?' => 12]
        // );


        //Delete:

        // $write->delete(
        //     $table,
        //     ['product_id IN (?)' => [25, 32]]
        // );


        //Insert Multiple:

        // $rows = [
        //     ['sku'=>'value1', 'cost'=>'value2', 'price'=>'value3'],
        //     ['sku'=>'value3', 'cost'=>'value4', 'price'=>'value5'],
        // ];
        // $write->insertMultiple($table, $rows);


        //Insert Update On Duplicate:

        // $data = [];
        // $data[] = [
        //     'sku' => 'BGSDGH',
        //     'cost' => 50000
        // ];

        // $write->insertOnDuplicate(
        //     $table,
        //     $data, // Could also be an array of rows like insertMultiple
        //     ['cost'] // this is the fields that will be updated in case of duplication
        // );

        die;
    }

    public function firstAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_one', 'query'));
        $this->renderLayout();
    }

    public function secoundAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_two', 'query'));
        $this->renderLayout();
    }

    public function thirdAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_three', 'query'));
        $this->renderLayout();
    }

    public function fourthAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_four', 'query'));
        $this->renderLayout();
    }
    
    public function fifthAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_five', 'query'));
        $this->renderLayout();
    }

    public function sixthAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_six', 'query'));
        $this->renderLayout();
    }

    public function seventhAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_seven', 'query'));
        $this->renderLayout();
    }

    public function eighthAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_eight', 'query'));
        $this->renderLayout();
    }

    public function ninthAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_nine', 'query'));
        $this->renderLayout();
    }

    public function tenthAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_ten', 'query'));
        $this->renderLayout();
    }

    public function viewoneAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $tableName = $resource->getTableName('catalog/product');
        $select = $readConnection->select()
            ->from(array('p' => $tableName), array(
                'sku' => 'p.sku',
                'name' => 'ov.value',
                'price' => 'a.value',
                'cost' => 'b.value',
                'color' => 'c.value',
            ))
            ->joinLeft(
                array('ov' => $resource->getTableName('catalog_product_entity_varchar')),
                'ov.entity_id = p.entity_id AND ov.attribute_id = 73',
                array()
            )
            ->joinLeft(
                array('a' => $resource->getTableName('catalog_product_entity_decimal')),
                'a.entity_id = p.entity_id AND a.attribute_id = 77',
                array()
            )
            ->joinLeft(
                array('b' => $resource->getTableName('catalog_product_entity_decimal')),
                'b.entity_id = p.entity_id AND b.attribute_id = 81',
                array()
            )
            ->joinLeft(
                array('c' => $resource->getTableName('catalog_product_entity_int')),
                'c.entity_id = p.entity_id AND c.attribute_id = 94',
                array()
            );

        echo $select;
    }

    public function viewtwoAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('ao' => $attributeOptionTable),
                array(
                    'attribute_id' => 'ao.attribute_id',
                    'option_id' => 'ao.option_id',
                    'option_name' => 'ov.value',
                )
            )
            ->joinLeft(
                array('ov' => $resource->getTableName('eav_attribute_option_value')),
                'ov.option_id = ao.option_id',
                array()
            )
            ->join(
                array('a' => $attributeTable),
                'a.attribute_id = ao.attribute_id',
                array('attribute_code' => 'a.attribute_code')
            );

        echo $select;die;
    }

    public function viewthreeAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('main_table' => $attributeTable),
                array(
                    'attribute_id' => 'main_table.attribute_id',
                    'attribute_code' => 'main_table.attribute_code',
                )
            )
            ->joinLeft(
                array('option_count_table' => $attributeOptionTable),
                'option_count_table.attribute_id = main_table.attribute_id',
                array(
                    'option_count' => 'COUNT(option_count_table.option_id)',
                )
            )
            ->group('main_table.attribute_id')
            ->having('COUNT(option_count_table.option_id) > 1', 1);

        echo '<br><br>'.$select;die;
    }

    public function viewfourAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('vc'=>$resource->getTableName('catalog_product_entity_varchar')),
                'vc.entity_id = main_table.entity_id AND vc.attribute_id = 87',
                array('image' => 'vc.value')
            )
            ->joinLeft(
                array('thumb'=>$resource->getTableName('catalog_product_entity_varchar')),
                'thumb.entity_id = main_table.entity_id AND thumb.attribute_id = 89',
                array('thumbnail' => 'thumb.value')
            )
            ->joinLeft(
                array('small'=>$resource->getTableName('catalog_product_entity_varchar')),
                'small.entity_id = main_table.entity_id AND small.attribute_id = 88',
                array('small' => 'small.value')
            );
    }

    public function viewfiveAction()
    {
         $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('m'=>$resource->getTableName('catalog/product_attribute_media_gallery')),
                'm.entity_id = main_table.entity_id',
                array('image' => 'COUNT(m.value)')
            )
            ->group('main_table.entity_id');
    }

    public function viewsixAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('e'=>$resource->getTableName('customer_entity_varchar')),
                'e.entity_id = main_table.entity_id AND e.attribute_id = 5',
                array('firstname' => 'e.value')
            )
            ->joinLeft(
                array('o' => $resource->getTableName('sales/order')),
                'o.customer_id = e.entity_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->group('main_table.entity_id');
    }

    public function viewsevenAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        echo $select = $readConnection->select()
            ->from(
                array('main_table'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('e'=>$resource->getTableName('customer_entity_varchar')),
                'e.entity_id = main_table.entity_id AND e.attribute_id = 5',
                array('firstname' => 'e.value')
            )
            ->joinLeft(
                array('o' => $resource->getTableName('sales/order')),
                'o.customer_id = e.entity_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->joinLeft(
                array('s' => Mage::getSingleton('core/resource')->getTableName('sales_order_status')),
                'o.status = s.status',
                array('order_status' => 's.label')
            )
            ->group('main_table.entity_id');
    }

    public function vieweightAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $productsTable = $resource->getTableName('catalog/product');
        $orderItemsTable = $resource->getTableName('sales/order_item');

        echo $query = $resource->getConnection('core_read')
            ->select()
            ->from(array('e' => $productsTable))
            ->joinLeft(
                array('oi' => $orderItemsTable),
                'e.entity_id = oi.product_id',
                array('sold_quantity' => 'SUM(oi.qty_ordered)')
            )
            ->group('e.entity_id');
    }

    public function viewnineAction()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $tablePrefix = Mage::getConfig()->getTablePrefix();

        echo $select = $connection->select()
        ->from(array('e' => $tablePrefix . 'catalog_product_entity'), 'entity_id AS product_id')
        ->join(
            array('a' => $tablePrefix . 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )
        ->joinLeft(
            array('avc' => $tablePrefix . 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avi' => $tablePrefix . 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avd' => $tablePrefix . 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avt' => $tablePrefix . 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )
        ->where('avc.value IS NULL AND avi.value IS NULL AND avd.value IS NULL AND avt.value IS NULL')
        ->where('a.is_user_defined = ?', 1);
    }

    public function viewtenAction()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        echo $tablePrefix = Mage::getConfig()->getTablePrefix();

        echo $select = $connection->select()
            ->from(array('e' => $tablePrefix . 'catalog_product_entity'), 'entity_id AS product_id')
            ->join(
                array('a' => $tablePrefix . 'eav_attribute'),
                'e.entity_type_id = a.entity_type_id',
                array('attribute_id', 'attribute_code')
            )
            ->joinLeft(
                array('avc' => $tablePrefix . 'catalog_product_entity_varchar'),
                'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avi' => $tablePrefix . 'catalog_product_entity_int'),
                'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avd' => $tablePrefix . 'catalog_product_entity_decimal'),
                'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
                array()
            )
            ->joinLeft(
                array('avt' => $tablePrefix . 'catalog_product_entity_text'),
                'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
                array()
            )
            ->columns(array(
                'value' => new Zend_Db_Expr('COALESCE(avc.value, avi.value, avd.value, avt.value)')
            ))
            ->where('(avc.value IS NOT NULL OR avi.value IS NOT NULL OR avd.value IS NOT NULL OR avt.value IS NOT NULL)')
            ->where('a.is_user_defined = ?', 1);
    }
}
