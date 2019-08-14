<?php

class Proxymit_StoreShipper_Helper_Data extends Mage_Core_Helper_Abstract
{
public function getOrderClientName($id_order){
		$order = Mage::getModel('sales/order')->load($id_order);
		$custname = $order->getCustomerName();
		return $custname;
	}
	public function getStoreViewName($available){
		if($available != "-1"){
			$store = Mage::getModel('core/store')->load($available)->getName();
		}else {
			$store = "Show in all stores";
		}
		return $store;
	}
public function getOrderMethod($id_order){
		$order = Mage::getModel('sales/order')->load($id_order);
		$carr = $order->getShippingCarrier()->getCarrierCode();
		return $carr;
	}
	public function getCountryName($id){
		$country_name=Mage::app()->getLocale()->getCountryTranslation($id);
		return $country_name;
	}
	
	
	
	/// GENERATE CSV
	
	protected $_list = null;
	
	public function __construct()
	{
		$collection = Mage::getModel('storeshipper/stores')->getCollection();
	
		$this->setList($collection);
	}
	
	/**
	 * Sets current collection
	 * @param $query
	 */
	public function setList($collection)
	{
		$this->_list = $collection;
	}
	
	/**
	 * Returns indexes of the fetched array as headers for CSV
	 * @param array $products
	 * @return array
	 */
	protected function _getCsvHeaders($products)
	{
		$product = current($products);
		$headers = array_keys($product->getData());
	
		return $headers;
	}
	
	/**
	 * Generates CSV file with product's list according to the collection in the $this->_list
	 * @return array
	 */
	public function generateMlnList()
	{
		if (!is_null($this->_list)) {
			$items = $this->_list->getItems();
			if (count($items) > 0) {
	
				$io = new Varien_Io_File();
				$path = Mage::getBaseDir('var') . DS . 'export' . DS;
				$name = md5(microtime());
				$file = $path . DS . $name . '.csv';
				$io->setAllowCreateFolders(true);
				$io->open(array('path' => $path));
				$io->streamOpen($file, 'w+');
				$io->streamLock(true);
	
				$io->streamWriteCsv($this->_getCsvHeaders($items));
				foreach ($items as $product) {
					$io->streamWriteCsv($product->getData());
				}
	
				return array(
						'type'  => 'filename',
						'value' => $file,
						'rm'    => true // can delete file after use
				);
			}
		}
	}
	
	
	
	
}