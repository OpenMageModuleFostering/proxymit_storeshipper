<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Related Orders
 * Comments : Show Customer Name in the Related Orders Grid
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Country extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
	public function render(Varien_Object $row) {
		$value = $row->getData();
		return '<span>' . Mage::helper("storeshipper")->getCountryName($value["country"]) . '</span>';
	}
}