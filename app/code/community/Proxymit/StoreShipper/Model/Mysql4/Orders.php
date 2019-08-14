<?php

class Proxymit_StoreShipper_Model_Mysql4_Orders extends Mage_Core_Model_Mysql4_Abstract
{
	public function _construct()
	{
		$this->_init('storeshipper/orders', 'id');
	}
}