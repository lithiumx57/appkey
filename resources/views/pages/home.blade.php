@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/home.css?q=".getAssestVersion())}}">
  <link rel="stylesheet" href="{{asset("assets/libs/css/swiper.min.css")}}">
@endsection

@section("content")

  <div class="container slider-container">
    <x-home.slider/>
  </div>

  <livewire:public-components.product-box/>
  <livewire:home-page.home-platforms/>
  <livewire:home-page.home-latest-articles/>

@endsection

@section("scripts")
  <script src="{{asset("assets/libs/js/swiper.min.js")}}"></script>
  <script src="{{asset("assets/js/home2.js")}}"></script>

@endsection
