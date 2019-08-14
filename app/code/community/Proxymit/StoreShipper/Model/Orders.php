<?php
class Proxymit_StoreShipper_Model_Orders extends Mage_Core_Model_Abstract
{
	 
	public function _construct()
	{
		parent::_construct();
		$this->_init('storeshipper/orders');
	}

}