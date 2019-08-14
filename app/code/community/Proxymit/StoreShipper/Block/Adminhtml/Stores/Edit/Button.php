<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Contact Information->Add Images
 *
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Button extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface {
	public function render(Varien_Data_Form_Element_Abstract $element) {
		$html = '
				<input type="button" value="Add Image" onclick="editForm.submit($(\'edit_form\').action+\'back/edit/id/2\');" />
				';
		return '';
	}
}