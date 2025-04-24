<!doctype html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <x-seo::meta/>
  <meta name="robots" content="noindex">
  <link rel="preload" href="{{asset("assets/fonts/woff2/YekanBakhFaNum-Regular.woff2")}}" as="font" type="font/woff2" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset("assets/css/layout.css?q=".getAssestVersion())}}">
  @yield("styles")

</head>
<body class="@if(getTheme()=="dark") dark @endif">

@include("layouts.header.main-header")


  <div style="width: 100%;height: 100%;position: fixed;left: 0;right: 0;top: 0;bottom: 0;z-index: 0">
    <div class="background-light light1"></div>
    <div class="background-light light2"></div>
  </div>

  <div class="x-backdrop" id="x-backdrop"></div>


  <main id="main-content">
    @yield("content")
    <livewire:popup-login/>
  </main>


@if(!isset($noFooter))
  <footer>
    <livewire:layouts.bottom-navigation/>
    <livewire:layouts.footer.footer-index :has-footer="isset($hasFooter)?$hasFooter:true"/>
  </footer>
@endif


  <script src="{{asset("assets/js/app.js?q=".getAssestVersion())}}"></script>
@yield("scripts")

</body>
</html>
