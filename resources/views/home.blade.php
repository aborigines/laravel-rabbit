<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="http://maps.google.com/maps/api/js"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/gmaps.min.js') }}"></script>
  <style type="text/css">
    #map {
      width: 800px;
      height: 600px;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <script>
    datas = {!! json_encode($datas) !!}
    var map = new GMaps({
      el: '#map',
      lat: datas[0]['geo']['coordinates'][0],
      lng: datas[0]['geo']['coordinates'][1]
    });

    $.each(datas, function( index, value ) {
      map.addMarker({
        lat: value['geo']['coordinates'][0],
        lng: value['geo']['coordinates'][1],
        icon: value['user']['profile_image_url'],
        infoWindow: {
        content: '<p>'+ value['text']+'</p>'
        }
      });
    });
  </script>

</body>
</html>