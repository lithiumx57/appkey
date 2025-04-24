@extends("layouts.main")
@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/platform.css")}}">
@endsection
@section("content")
  <livewire:platform.platform-page :slug="$slug"/>
@endsection
