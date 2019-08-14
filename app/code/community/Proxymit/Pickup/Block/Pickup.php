<?php
class Proxymit_Pickup_Block_Pickup extends Mage_Checkout_Block_Onepage_Shipping_Method_Available
{
	public function __construct(){
		$this->setTemplate('pickup/pickup.phtml');		
	}
	// Show only available in Storeview
	public function filterStores($data){
		$res = array();
		foreach ( $data as $st ){
			if($st['available_at_storeview'] == -1 || $st['available_at_storeview'] == Mage::app()->getStore()->getStoreId()){
				array_push($res,$st);
			}
		}
		return $res;
	}
	public function getAllStores() {
		$collection = Mage::getModel ( 'storeshipper/stores' )->getCollection ();
		$data=$collection->getData ();
		return $this->filterStores($data);
	}
}