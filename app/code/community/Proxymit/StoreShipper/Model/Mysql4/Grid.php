<?php

class Proxymit_StoreShipper_Model_Mysql4_Grid extends Mage_Core_Model_Mysql4_Abstract
{
	public function _construct()
	{
		$this->_init('storeshipper/stores', 'id');
	}
	public function addGridPosition($collection,$manager_id){
// 		$table2 = $this->getMainTable();
	}
}