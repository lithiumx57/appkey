@extends("layouts.main")
@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/search.css")}}">
@endsection
@section("content")
  <livewire:search.search-page :q="$q"/>

@endsection
