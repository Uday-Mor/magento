<?php
class Ccc_Practice_Adminhtml_CsvController extends Mage_Adminhtml_Controller_Action
{
    protected $_data = array();
    protected $_dataFinal = array();
    protected $_header = array();
    protected $_file = 'ATTRIBUTE-OPTIONS.csv';
    protected $_fileReport = 'report.csv';

    protected $_categoryData = array();
    protected $_categoryHeader = array();

    protected $_categoryFile = 'CATEGORY.csv';

    public function indexAction()
    {
        $this->_loadFile();
        $this->_formatData();
        $this->_generateReport();
        echo "DONE";
    }

    public function _loadFile()
    {
        $file = new Varien_File_Csv();
        $file->setLineLength(4096);
        $file->setDelimiter(',');
        $file->setEnclosure('\"');
        if ($categoryData  = $file->getData($this->_categoryFile)) {
            foreach ($categoryData as $category) {
                if(!$this->_categoryHeader)
                {
                    $this->_categoryHeader = $category;
                }
                else
                {
                    $category = array_combine($this->_categoryHeader, $category);
                    $this->_categoryData[$category["CATEGORY"]] = $category["CATEGORY"];
                }
            }
        }

        if ($attributrData  = $file->getData($this->_file)) {
            foreach ($attributrData as $attribute) {
                if(!$this->_header)
                {
                    $this->_header = $attribute;
                }
                else
                {
                    $attribute = array_combine($this->_header, $attribute);
                    $this->_data[$attribute["ATTRIBUTE"]][$attribute["OPTION"]] = $attribute["OPTION"];
                }
            }
        }
    }

    public function _formatData()
    {
        if(!$this->_data)
        {
            throw new Exception("Data is not available");
        }
        
        if(!$this->_categoryData)
        {
            throw new Exception("Category data is not available");
        }
        
        foreach($this->_categoryData as $_category)
        {
            foreach($this->_data as $attribute => $options)
            {
                $tmp = array(
                    "category" => $_category, 
                    "attribute" => $attribute
                );

                if(!isset($this->_data[$attribute]))
                {
                    continue;
                    //throw new ErrorException("Attribute missing in file : ".$att);
                }
                
                foreach($this->_data[$attribute] as $option)
                {
                    $tmp["option"] = $option;
                    $this->_dataFinal[] = $tmp;
                }
            }
        }
    }

    protected function _generateReport()
    {   
        $outputArray[] = array_keys($this->_dataFinal[0]);
        foreach ($this->_dataFinal as $element) {
            $outputArray[] = array_values($element);
        }

        if($this->_dataFinal)
        {
            $file = new Varien_File_Csv();
            $file->setDelimiter(',');
            $file->saveData($this->_fileReport,$outputArray);
        }
    }
}
