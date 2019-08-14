<?php
class Proxymit_Pickup_Model_Observer extends Varien_Object {
	public function saveShippingMethod($evt) {
		$request = $evt->getRequest ();
		$quote = $evt->getQuote ();
		$pickup = $request->getParam ( 'shipping_pickup', false );
		$quote_id = $quote->getId ();
		$data = array (
				$quote_id => $pickup 
		);
		$rate = $quote->getShippingAddress()->getShippingMethod();
		if ($pickup && $rate=="pickup_pickup") {
			Mage::getSingleton ( 'checkout/session' )->setPickup ( $data );
			$storeCoord = Mage::getModel ( "storeshipper/stores" )->load ( $pickup ["id_store"] );
			$quote->getShippingAddress ()->setData ( 'firstname', $storeCoord->getName () );
			$quote->getShippingAddress ()->setData ( 'lastname', 'Store' );	
			$quote->getShippingAddress ()->setData ( 'street', $storeCoord->getAdress() );	
			$quote->getShippingAddress ()->setData ( 'city' , $storeCoord->getCity() );	
			$quote->getShippingAddress ()->setData ( 'postcode' , $storeCoord->getZipcode() );	
			$quote->getShippingAddress ()->setData ( 'country' , $storeCoord->getCountry() );	
			$quote->getShippingAddress ()->setData ( 'telephone' , $storeCoord->getPhone() );	
			$quote->getShippingAddress ()->setData ( 'fax' , $storeCoord->getFax() );
			
// 			$shipping_amount = $quote->getShippingAmount();
// 			$quote->setShippingAmount( $shipping_amount + 30 );
// 			Mage::log($shipping_amount);
		}
		//print_r ( $data );
	}
	public function saveOrderAfter($evt) {
		$order = $evt->getOrder ();
		$quote = $evt->getQuote ();
		$quote_id = $quote->getId ();
		$pickup = Mage::getSingleton ( 'checkout/session' )->getPickup ();
		if (isset ( $pickup [$quote_id] )) {
			$data = $pickup [$quote_id];
			$data ['order_id'] = $order->getId ();
			$pickupModel = Mage::getModel ( 'pickup/pickup' );
			$pickupModel->setData ( $data );
			$pickupModel->save ();
			//Mage::log ( $data );
			$storeshipperModel = Mage::getModel ( 'storeshipper/orders' );
			$d = array ();
			$d ['id_order'] = $order->getId ();
			$d ['id_store'] = $data ['id_store'];
			$storeshipperModel->setData ( $d );
			$storeshipperModel->save ();
		}
	}
	public function loadOrderAfter($evt) {
		$order = $evt->getOrder ();
		if ($order->getId ()) {
			$order_id = $order->getId ();
			$pickupCollection = Mage::getModel ( 'storeshipper/orders' )->getCollection ();
			$pickupCollection->addFieldToFilter ( 'id_order', $order_id );
			$pickup = $pickupCollection->getFirstItem ();
			$order->setPickupObject ( $pickup );
			//Mage::log($pickup);
		}
	}
	public function loadQuoteAfter($evt) {
		$quote = $evt->getQuote ();
		if ($quote->getId ()) {
			$quote_id = $quote->getId ();
			$pickup = Mage::getSingleton ( 'checkout/session' )->getPickup ();
			if (isset ( $pickup [$quote_id] )) {
				$data = $pickup [$quote_id];
				$quote->setPickupData ( $data );
			}
			// Mage::log($pickup);
		}
	}
}