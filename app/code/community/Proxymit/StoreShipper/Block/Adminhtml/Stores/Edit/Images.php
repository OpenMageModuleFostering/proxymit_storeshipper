<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Contact Information
 * Comments : Get Images of the store from BASE_URL/media/storeshipper/{id_store}/
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Images extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface {
	public function render(Varien_Data_Form_Element_Abstract $element) {
		$html = '<div>';
		$path = Mage::getBaseDir ( 'media' ) . DS . 'storeshipper' . DS .$this->getRequest()->getParam('id'). DS;
		$array = $this->dirFiles ( $path );
		foreach ( $array as $key => $file ) {
			$p = Mage::getBaseUrl ( Mage_Core_Model_Store::URL_TYPE_MEDIA ) . 'storeshipper' . DS .$this->getRequest()->getParam('id'). DS . $file;
			$html .= '<div align="center" style="display: inline-block;">
				<a target="_blank" href="' . $p . '"><img style="max-width: 150px;" src="' . $p . '" /></a>
				<br><input class="button form-button" onclick="location.href=\''.$this->getUrl('*/*/deleteImage').'imagename/'.$file.'/id/'.$this->getRequest()->getParam('id').'\'" value="Delete" type="button" /></div>';
		}
		$html .= '</div><br /><hr /><br />';
		return $html;
	}
	function dirFiles($directry) {
		$dir = dir ( $directry ); // Open Directory
		if ($dir != NULL) {
			while ( false !== ($file = $dir->read ()) ) 			// Reads Directory
			{
				$extension = substr ( $file, strrpos ( $file, '.' ) ); // Gets the File
				                                                 // Extension
				if ($extension == ".png" || $extension == ".jpg" || $extension == ".bmp" | $extension == ".gif" | $extension == ".jpeg") // Extensions
				                                                                                                                      // Allowed
					$filesall [$file] = $file; // Store in Array
			}
			$dir->close (); // Close Directory
			asort ( $filesall ); // Sorts the Array
			return $filesall;
		}
	}
}