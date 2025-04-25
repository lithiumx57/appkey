@extends("layouts.main")

@section("styles")
  <style>
    #main-search-keyword {
      border: 0;
      outline: 0;
      width: 100%;
      display: block;
      height: 42px;
      background: transparent;
    }

    .search-icon {
      position: absolute;
      left: 16px;
      top: 0;
      bottom: 0;
      margin: auto auto;
      fill: #666;
    }

    .main-search-container {
      border-radius: 18px;
      height: 42px;
      outline: none;
      background: var(--input-background);
      border: 1px solid var(--border-color);
      width: 480px;
      max-width: calc(100% - 32px);
      margin: auto;
      display: block;
      top: 64px;
      bottom: 0;
      right: 0;
      left: 0;
      position: absolute;
      margin: auto auto;
      padding: 0 16px 0 42px;
      text-align: center;
    }

    #search-container {
      height: 120px;
      outline: none;
      width: 480px;
      max-width: calc(100% - 96px);
      margin: auto;
      display: block;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      position: fixed;
      margin: auto auto;
      transition: 400ms;

    }

    .search-logo {
      text-align: center;
      position: absolute;
      left: 0;
      right: 0;
      font-size: 40px;
      margin: auto;
    }

    .has-search {
      top: -400px !important;
      transition: 400ms;
      height: 600px;
    }

  </style>
@endsection


@section("content")
  <livewire:search.search-index/>
@endsection


@section("scripts")
  <script>
    document.addEventListener("keyup",function (event){
      if(event.key==="Enter"){
        if(event.target.value.length < 3){
          return;
        }
        window.location.href="/search?q="+event.target.value;
      }
    })
  </script>
@endsection
