<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Frontend Block
 * Location : Our Stores
 *
 */
class Proxymit_StoreShipper_Block_OurStores extends Mage_Core_Block_Template {
	/**
	 * Get All Stores
	 * return collection of stores
	 */
	
	// Show only available in Storeview
	public function filterStores($data){
		$res = array();
		foreach ( $data as $st ){
			if(($st['status'] == 1 )&&($st['available_at_storeview'] == -1 || $st['available_at_storeview'] == Mage::app()->getStore()->getStoreId())){
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
	/**
	 * Get Store name by ID
	 * return string
	 */
	public function getStoreName($idStore = '0') {
		$str = '';
		return $idStore;
	}

	/**
	 * Get Stores collection by Country, state, city, zipcode
	 * return string
	 */
	public function findStores($country = '', $state = '', $city = '', $zip = '') {
		$collection = Mage::getModel ( 'storeshipper/stores' )->getCollection ();
		$collection->addFieldToFilter ( 'country', array (
				'like' => array ("%".$country."%")
		) );
		return $collection->getData ();
	}
}