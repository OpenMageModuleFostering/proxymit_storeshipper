<?php
/**
 * 
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store
 * Comments : Main Tabs Container
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

	public function __construct()
	{
		
		parent::__construct();
		$this->setId('form_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('storeshipper')->__('Store Information'));
		
	}

	protected function _beforeToHtml()
	{
		
		$this->addTab('form_section', array(
				'label'     => Mage::helper('storeshipper')->__('General Information'),
				'title'     => Mage::helper('storeshipper')->__('General Information'),
				'content'   => $this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tab_form')->toHtml(),
		));
		$this->addTab('contact_section', array(
				'label'     => Mage::helper('storeshipper')->__('Contact Information'),
				'title'     => Mage::helper('storeshipper')->__('Contact Information'),
				'content'   => $this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tab_contact')->toHtml(),
		));
		$this->addTab('geo_section', array(
				'label'     => Mage::helper('storeshipper')->__('Geolocation'),
				'title'     => Mage::helper('storeshipper')->__('Geolocation'),
				'content'   => $this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tab_geo')->toHtml(),
		));
		$this->addTab('schedule_section', array(
				'label'     => Mage::helper('storeshipper')->__('Schedule'),
				'title'     => Mage::helper('storeshipper')->__('Schedule'),
				'content'   => $this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tab_schedule')->toHtml(),
		));
		$this->addTab('orders_section', array(
				'label'     => Mage::helper('storeshipper')->__('Related Orders'),
				'title'     => Mage::helper('storeshipper')->__('Related Orders'),
				'content'   => $this->getLayout()->createBlock('storeshipper/adminhtml_stores_edit_tab_grid')->toHtml(),
		));

		return parent::_beforeToHtml();
	}
}