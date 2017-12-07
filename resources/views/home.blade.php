@extends('layouts.main')

@section('title', 'Twitter Search')

@section('content')
<h1>Twitter Search</h1>

<div class="row form-group">
  <form method="GET" action="{{ url('/') }}">
    <div class="form-inline">
      <label for="usr">City</label>
      <input type="text" class="form-control"name="city" id="city" value="{{ isset($city) ? $city : ''}}" required="true"/>
      <input type="submit" value="Search" class="btn btn-primary form-control">
      <a class="btn btn-info form-control" href="{{ url('/history') }}" role="button">History</a>
    </div>
  </form>
</div>

<div class="row">
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
@endsection