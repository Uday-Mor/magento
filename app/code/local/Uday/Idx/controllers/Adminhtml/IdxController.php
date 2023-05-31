<?php

class Uday_Idx_Adminhtml_IdxController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('idx/idx')
            ->_addBreadcrumb(Mage::helper('idx')->__('idx Manager'), Mage::helper('idx')->__('idx Manager'))
            ->_addBreadcrumb(Mage::helper('idx')->__('Manage idx'), Mage::helper('idx')->__('Manage idx'))
        ;
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Idx'))->_title($this->__('Manage Idx'));
        $this->loadLayout();
        $this->_addContent(
            $this->getLayout()->createBlock('idx/adminhtml_idx', 'idx')
        );
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('idx'))
             ->_title($this->__('idxs'))
             ->_title($this->__('Edit idxs'));

        $id = $this->getRequest()->getParam('idx_id');
        $model = Mage::getModel('idx/idx');

        if ($id) {
            $model->load($id);
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New idx'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('idx_edit',$model);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('idx')->__('Edit idx')
                    : Mage::helper('idx')->__('New idx'),
                $id ? Mage::helper('idx')->__('Edit idx')
                    : Mage::helper('idx')->__('New idx'));

        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx_edit'))
                ->_addLeft($this->getLayout()->createBlock('idx/adminhtml_idx_edit_tabs'));

        $this->renderLayout();
    }

    public function importAction()
    {
        if (isset($_FILES['csv']['tmp_name']) && !empty($_FILES['csv']['tmp_name'])) {
            $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
            $tableName = Mage::getSingleton('core/resource')->getTableName('import_product_idx');
            $connection->truncate($tableName);
            $csvFile = $_FILES['csv']['tmp_name'];
            $csvData = array_map('str_getcsv', file($csvFile));
            $columns = $csvData[0];
            unset($csvData[0]);
            $counter = 0;
            foreach ($csvData as $data) {
                $counter ++;
                $row['sku'] = $data[0];
                $row[$columns[1]] =  $data[1];
                $row[$columns[2]] =  $data[2];
                $row[$columns[3]] =  $data[3];
                $row[$columns[4]] =  $data[4];
                $row[$columns[5]] =  $data[5];
                $row[$columns[6]] =  $data[6];
                $row[$columns[7]] =  $data[7];
                $row[$columns[8]] =  $data[8];
                $query = $connection->insertOnDuplicate(
                    $tableName,
                    $row,
                    array_keys($row)                
                );
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('adminhtml')->__('Total of %d record(s) were saved.', $counter)
            );
        } else {
            Mage::getSingleton('adminhtml/session')->addError('No CSV file uploaded.');
        }

        $this->_redirect('*/*/index');
    }

    public function downloadAction()
    {
        $filePath = Mage::getModuleDir('', 'Hk_Productimport') . DS . 'data' . DS . 'example.xlsx';

        // Check if the file exists
        if (file_exists($filePath)) {
            $this->_prepareDownloadResponse('example.xlsx', file_get_contents($filePath));
        } else {
            $this->_forward('noRoute');
        }
    }

    public function brandAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');
            $idxCollection = $idx->getCollection();
            $idxBrandNames = [];
        
            foreach ($idxCollection as $idx) {
                $idxBrandNames[] = $idx->getData('brand');
            }

            $newBrands = $idx->updateMainBrand(array_unique($idxBrandNames));
            $idx->updateBrandId();

            Mage::getSingleton('adminhtml/session')->addSuccess('Brand is fine now');
            $this->_redirect('*/*/');
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

    public function collectionAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');
            $idxCollection = $idx->getCollection();
            $idxCollectionNames = [];
        
            foreach ($idxCollection as $idx) {
                $idxCollectionNames[] = $idx->getData('collection');
            }

            $newCollections = $idx->updateMainCollection(array_unique($idxCollectionNames));
            $idx->updateCollectionId();

            Mage::getSingleton('adminhtml/session')->addSuccess('Collection is fine now');
            $this->_redirect('*/*/');
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

    public function productAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');
            $idxCollection = $idx->getCollection();
            foreach ($idxCollection as $idx) {
                if (!$idx->checkBrand()) {
                    Mage::getSingleton('adminhtml/session')->addError('Brand is not fine');
                    $this->_redirect('*/*/');
                    return;
                }

                if (!$idx->checkCollection()) {
                    Mage::getSingleton('adminhtml/session')->addError('Collection is not fine');                    
                    $this->_redirect('*/*/');
                    return;
                }
            }

            $idxSku = [];
            foreach ($idxCollection as $idx) {
                $idxSku[] = $idx->getData('sku');
            }

            $newProducts = $idx->updateMainProduct(array_unique($idxSku));
            $idx->updateProductId();
            $idx->updateProductData();
            Mage::getSingleton('adminhtml/session')->addSuccess('Product is fine now');
            $this->_redirect('*/*/');
        } catch (Exception $e) {
            
        }
    }
}
