<!DOCTYPE html>
<html>
<head> 
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="https://maps.google.com/maps/api/js"></script>
  <script src="{{ asset('js/gmaps.min.js') }}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    #map {
      width:50%;
      height:400px !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <form method="GET" action="{{url('/')}}">
      <input type="text" name="city" id="city" value="{{ isset($city) ? $city : ''}}" required="true"/>
    </form>

    <div id="map"></div>

    <script>
      datas = {!! json_encode($datas) !!}

      var map = new GMaps({
        el: '#map',
        lat: {!! $latitude !!},
        lng: {!! $longitude !!},
        zoom: 10
      });

      $.each(datas, function( index, value ){
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
  </div>
</body>
</html>