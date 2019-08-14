<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block 
 * Location : StoreShipper->Manage Stores
 * 
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
   	
       parent::__construct();
       $this->setId('storesGrid');
       $this->setDefaultSort('id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('storeshipper/stores')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
   protected function _prepareColumns()
   {
       $this->addColumn('id',
             array(
                    'header' => 'ID',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'id',
               ));
       $this->addColumn('name',
               array(
                    'header' => 'name',
                    'align' =>'left',
                    'index' => 'name',
              ));
       $this->addColumn('status',
               array(
                    'header' => 'Status',
                    'align' =>'left',
                    'index' => 'status',
              ));
       $this->addColumn('shipping_price',
               array(
                    'header' => 'Shipping Price',
                    'align' =>'left',
                    'index' => 'shipping_price',
              ));
       $this->addColumn('adress',
               array(
                    'header' => 'Adress',
                    'align' =>'left',
                    'index' => 'adress',
              ));
       $this->addColumn('zipcode',
               array(
                    'header' => 'Zip Code',
                    'align' =>'left',
                    'index' => 'zipcode',
              ));
       $this->addColumn('city',
               array(
                    'header' => 'City',
                    'align' =>'left',
                    'index' => 'city',
              ));
       $this->addColumn('state',
               array(
                    'header' => 'State',
                    'align' =>'left',
                    'index' => 'state',
              ));
       $this->addColumn('country',
               array(
                    'header' => 'Country',
                    'align' =>'left',
                    'index' => 'country',
               		'renderer' => 'Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Country'
              ));
       $this->addColumn('available_at_storeview',
               array(
                    'header' => 'Available at storeview',
                    'align' =>'left',
                    'index' => 'available_at_storeview',
               		'renderer' => 'Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_StoreViewColumn'
              ));

       $this->addExportType('*/*/exportCsv', Mage::helper('storeshipper')->__('CSV'));
       $this->addExportType('*/*/exportXml', Mage::helper('storeshipper')->__('XML'));
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
    	// This is where our row data will link to
    	return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }


}