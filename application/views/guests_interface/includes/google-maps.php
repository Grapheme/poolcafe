<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtgj1kQZnFLNOQaOkX1fB6Tu_ZeZXzGNI&sensor=false"></script>
<script type="text/javascript">
	function initialize() {
		var mapOptions = {
			zoom : 15,
			scrollwheel: false,
			center : new google.maps.LatLng(47.210951, 39.632921),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		var image = 'img/marker.png';
		var myLatLng = new google.maps.LatLng(47.210951, 39.632921);
		var beachMarker = new google.maps.Marker({
			position : myLatLng,
			map : map,
			icon : image
		});
	}
</script>