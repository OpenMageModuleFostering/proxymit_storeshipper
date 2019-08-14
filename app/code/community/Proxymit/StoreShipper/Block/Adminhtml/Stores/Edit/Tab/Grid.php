<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Related Orders Tab
 *
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tab_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
public function __construct()
   {
   	
       parent::__construct();
       $this->setId('storesGrid');
       $this->setDefaultSort('id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
       Mage::helper("storeshipper")->getOrderClientName(1);
   }
   protected function _prepareCollection()
   {
      $collection = Mage::getModel('storeshipper/orders')->getCollection();
      if($this->getRequest()->getParam('id')){
      $collection->addFilter('id_store', $this->getRequest()->getParam('id'));
      }else{
      	$collection->addFilter('id_store', null);
      }
      
      
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
       $this->addColumn('id_order',
               array(
                    'header' => 'Order',
                    'align' =>'left',
                    'index' => 'id_order',
              ));

       $this->addColumn('pickup_date',
       		array(
       				'header' => 'Ordered in',
       				'align' =>'left',
       				'index' => 'pickup_date',
       		));

       $this->addColumn('customer_name',
       		array(
       				'header' => 'customer_name',
       				'align' =>'left',
       				'renderer' => 'Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Html',
       		));
       
       $this->addExportType('*/*/exportCsv', Mage::helper('storeshipper')->__('CSV'));
       $this->addExportType('*/*/exportXml', Mage::helper('storeshipper')->__('XML'));
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
    	// This is where our row data will link to
//     	if (Mage::getSingleton('admin/session')->isAllowed('sales/order/actions/view')) {
//             return $this->getUrl('*/sales_order/view', array('order_id' => $row->getIdOrder()),array("admin"=>true));
//         }
        return Mage::helper("adminhtml")->getUrl("adminhtml/sales_order/view/", array('order_id' => $row->getIdOrder()));;
    }

}