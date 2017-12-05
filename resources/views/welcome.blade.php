<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="http://maps.google.com/maps/api/js"></script>
  <script src="{{ asset('js/gmaps.min.js') }}"></script>
  <style type="text/css">
    #map {
      width: 400px;
      height: 400px;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <script>
    var map = new GMaps({
      el: '#map',
      lat: -12.043333,
      lng: -77.028333
    });

    map.addMarker({
      lat: -12.043333,
      lng: -77.028333,
      title: 'Lima',
      infoWindow: {
      content: '<p>HTML Content</p>'
    }      
      // click: function(e) {
      //   alert('You clicked in this marker');
      // }
    }); 
  </script>
</body>
</html>