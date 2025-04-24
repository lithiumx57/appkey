@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/platforms.css?q=".getAssestVersion())}}">
@endsection

@section("content")

  <x-breadcrumb  :records="$breadcrumbs"/>
  <div class="x-container container-fluid p-list">

    <div class="p-list-container">

      <div class="x-container container-fluid p-list">
        @foreach($data["platforms"] as $platform)
          <a href="{{$platform["link"]}}" class="product-row" title="{{$platform["title_en"]}}">
            <div class="product box m-0">
              {!! buildChachedImage($platform["image"]) !!}
              <div class="ps-1">
                <p class="title mb-0">
                  {{$platform["title_fa"]}}
                </p>
                <div class="price">
                  {{$platform["productsCount"]}} محصول
                </div>
              </div>
            </div>
          </a>
        @endforeach
      </div>

    </div>
  </div>

@endsection
