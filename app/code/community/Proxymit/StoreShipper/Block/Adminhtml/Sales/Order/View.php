<?php 

/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Comment : ADDING Notification Buttons to the Order View if the Order is passed by StoreShipper Module
 *
 */

class Proxymit_StoreShipper_Block_Adminhtml_Sales_Order_View extends Mage_Adminhtml_Block_Sales_Order_View {
    public function  __construct() {

        // ADD Notify Buttons to the Order View if the Order Passed with StoreShipper
        if(Mage::helper("storeshipper")->getOrderMethod($this->getOrderId())=="pickup"){
        	// Verify Config : Store Manager Notification enabled
        	if(Mage::getStoreConfig('carriers/pickup/email_customer_active')){
		        $this->_addButton('notif_client', array(
		            'label'     => Mage::helper('storeshipper')->__('Notify Customer '),
		            'onclick'   => "confirmSetLocation('Send Email to Customer ?','".Mage::helper('adminhtml')->getUrl('storeshipper/adminhtml_index/notifyCustomer',array("order_id" => $this->getOrderId()))."')",
		            'class'     => 'go'
		        ), 0, 100, 'header', 'header');
        	}
        	// Verify Config : Store Manager Notification enabled
        	if(Mage::getStoreConfig('carriers/pickup/email_manager_active')){
		        $this->_addButton('notif_manager', array(
		            'label'     => Mage::helper('storeshipper')->__('Notify Store Manager'),
		            'onclick'   => "confirmSetLocation('Send Email to Store Manager ?','".Mage::helper('adminhtml')->getUrl('storeshipper/adminhtml_index/notifyStoreManager',array("order_id" => $this->getOrderId()))."')",
		            'class'     => 'go'
		        ), 0, 101, 'header', 'header');
	    	}
        }
        parent::__construct();
    }
    
}