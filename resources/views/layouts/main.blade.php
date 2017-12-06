<!DOCTYPE html>
<html>
<head> 
  <title>Laravel Rabbit - @yield('title')</title>
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
    @yield('content')
  </div>
</body>
</html>