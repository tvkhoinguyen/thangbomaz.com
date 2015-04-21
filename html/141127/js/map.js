function initialize() {
	var myLatlng = new google.maps.LatLng(1.435710, 103.843756);
	var myOptions = {
	  zoom: 18,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var contentString = '<div id="content">'+
		'<h1>Ark Cleaning Specialists Pte Ltd</h1>'+
		'<div>'+
		'<p>2 Yishun Industrial Street 1, # 01 - 32, Northpoint Bizhub, Singapore 768159 </p>'+
		'</div>'+
		'</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		maxWidth: 500
	});
	
	var companyImage = new google.maps.MarkerImage('img/pin.png',
		new google.maps.Size(131,76),
		new google.maps.Point(0,0)
	);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		icon: companyImage,
		title: 'Connect Tuition Agency'
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});

  }
	
 initialize();     