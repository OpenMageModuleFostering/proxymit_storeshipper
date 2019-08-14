<?php
class Proxymit_StoreShipper_Model_Schedule extends Mage_Core_Model_Abstract
{
	 
	public function _construct()
	{
		parent::_construct();
		$this->_init('storeshipper/schedule');
	}

}