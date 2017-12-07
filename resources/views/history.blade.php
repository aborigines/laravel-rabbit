@extends('layouts.main')

@section('title', 'History')

@section('content')
<h1>History</h1>
    <ul class="list-unstyled">
      <a href="{{ url('/') }}"><li>< Back To Twitter Search</li></a>

      @foreach($historyCity as $city)
      <li>{{ $city }}</li>
      @endforeach
      
      <li>fix for make scroll bar</li>
      <li>fix for make scroll bar</li>
      <li>fix for make scroll bar</li>
      <li>fix for make scroll bar</li>
      <li>fix for make scroll bar</li>
    </ul>
@endsection