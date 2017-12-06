@extends('layouts.main')

@section('title', 'Twitter\'s Search')

@section('content')
<h1>Tweet</h1>

<form method="GET" action="{{ url('/') }}">
  <input type="text" name="city" id="city" value="{{ isset($city) ? $city : ''}}" required="true"/>
  <input type="submit" value="Search" class="btn btn-primary">
  <a class="btn btn-info" href="{{ url('/history') }}" role="button">History</a>
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
@endsection