<?php
class Proxymit_Pickup_Model_Sales_Order extends Mage_Sales_Model_Order {

    public function getShippingDescription() {
        $desc = parent::getShippingDescription ();
        $pickupObject = $this->getPickupObject ();
        // Zend_Debug::dump($pickupObject->getData());
        // die();
        $googleApiKey = Mage::getStoreConfig ( 'carriers/pickup/google_api' );
        if ($pickupObject != NULL && $pickupObject->getData ()) {
            $store = Mage::getModel ( 'storeshipper/stores' )->getCollection ()->getItemById ( $pickupObject->getIdStore () );
            // $desc .= '<p><b>Pickup Date</b>: ' . Mage::app ()->getLocale
            // ()->date ( strtotime ( $pickupObject->getPickupDate () ), null,
            // null, false )->toString ( 'dd/MM/yyyy' ); right: 342px;width: 669px;
            $desc .= '<br/><b>'.Mage::helper('storeshipper')->__('Store Name').'</b>: ' . $store->getName ();
            $desc .= '<br/><b>'.Mage::helper('storeshipper')->__('Store Address').'</b>: ' . $store->getAdress () . ', ' . $store->getCity () . ', ' . Mage::helper("storeshipper")->getCountryName($store->getCountry ());
            $desc .= '<br /><a href="https://maps.google.com/maps?saddr=&daddr=('.$store->getLatitude().','.$store->getLongitude().')&hl=fr&ie=UTF8&sll=48.885953,2.242912&sspn=0.008113,0.01929&geocode=&oq=&t=h&mra=ls" target="_blank"><b>'.Mage::helper('storeshipper')->__('Itinerary').'</b></a>';
            $desc .= '<br/><b>'.Mage::helper('storeshipper')->__('Phone Number').'</b>: ' . $store->getPhone ();
            $desc .= '<br /><br /><br />';
            $desc .= '
				<div id="map-canvas" style="height: 270px; position: relative;"><img src="http://maps.googleapis.com/maps/api/staticmap?sensor=true&center='.$store->getLatitude().','.$store->getLongitude().'&zoom=8&markers=color:red%7Clabel:S%7C'.$store->getLatitude().','.$store->getLongitude().'&size=317x270&key=' . $googleApiKey . '" /></div>
					<script type="text/javascript"
			src="https://maps.googleapis.com/maps/api/js?key=' . $googleApiKey . '&sensor=true">
    		</script>
 			<script type="text/javascript">
					function initialize() {
					
        var mapOptions = {
          center: new google.maps.LatLng('.$store->getLatitude().','.$store->getLongitude().'),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
          var marker = new google.maps.Marker({
    position: new google.maps.LatLng('.$store->getLatitude().','.$store->getLongitude().'),
    title:"'.$store->getName ().'"});
    		
		marker.setMap(map);

		}
      google.maps.event.addDomListener(window, "load", initialize);
    		
    		
					</script>		
 					';
            $desc .= '</p>';
        }
        return $desc;
    }
}