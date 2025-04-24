@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/complete-info.css")}}">
@endsection

@section("content")
  <div class="x-container">
    <br>
    <livewire:cart.complete-information.user-info/>
  </div>
@endsection
