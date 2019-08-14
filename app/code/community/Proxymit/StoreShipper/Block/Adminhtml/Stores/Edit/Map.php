<?php
/**
 *
 * Proxymit_StoreShipper Module
 * Adminhtml Block
 * Location : StoreShipper->Manage Stores->Edit Store->Geolocation Information
 * Comments : Render Google Maps v3
 */
class Proxymit_StoreShipper_Block_Adminhtml_Stores_Edit_Map extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface {
	public function render(Varien_Data_Form_Element_Abstract $element) {
		$html = '
				<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?key='.Mage::getStoreConfig ( 'carriers/pickup/google_api' ).'&sensor=true">
    </script>
				<div id="map-canvas" style="height: 300px; width: 900px"></div><br><br>
				<script type="text/javascript">
	document.getElementById("form_tabs_geo_section").onclick=function(){document.getElementById("form_tabs_geo_section_content").style.display="block";initialize();initialize();};
var map = new google.maps.Map(document.getElementById("map-canvas"));
      function initialize() {
		map = new google.maps.Map(document.getElementById("map-canvas"));
        var mapOptions = {
          center: new google.maps.LatLng(document.getElementById("latitude").value,document.getElementById("longitude").value),
          zoom: 1,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
				addMarker(document.getElementById("latitude").value,document.getElementById("longitude").value,"");
				pointStore(document.getElementById("latitude").value,document.getElementById("longitude").value);
      }
    google.maps.event.addDomListener(window, "load", initialize);
	google.maps.event.trigger(map, "resize");
      function pointStore(lat, long){
      	map.panTo(new google.maps.LatLng(lat, long));
      	map.setZoom(6);
      }
      function addMarker(lat, long, name){
    	  var marker = new google.maps.Marker({
      		position: new google.maps.LatLng(lat, long),
      		map: map,
			draggable: true,
      		title: name
      	});
		google.maps.event.addListener(marker, "drag", function() { setCoord(marker.getPosition().lat(),marker.getPosition().lng()); } );
      }
		function setCoord(lt,lg){
			document.getElementById("latitude").value=lt;
			document.getElementById("longitude").value=lg;	
			google.maps.event.trigger(document.getElementById("latitude"), "blur");
		}
				
				
		
    </script>
				
				';
		return $html;
	}
}