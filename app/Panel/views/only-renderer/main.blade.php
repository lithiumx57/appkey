<!DOCTYPE html>
<html lang="fa" id="html">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>@isset($pageTitle) {{$pageTitle}} @else پنل مدیریت @endif</title>
  <link rel="stylesheet" href="{{asset('dashboard/css/only-renderer-light.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/css/admin-style.css')}}">
  <script src="{{asset("dashboard/js/jquery.min.js")}}"></script>
  {!! \App\Panel\UiHandler\StyleBuilder::build(\App\Panel\Models\Panel::class,$fields) !!}
  @yield('style')
</head>
<div id="x-helpers"
     data-admin-prefix="{{getAdminPrefix()}}"
     data-route=""
     data-is-trash-mode="{{isTrashMode()}}"
     data-use-x-table="@isset($model){{$model::$xTable}}@endisset"
></div>

<body class="bg-theme bg-theme2">
<div id="panel-version" data-version="{{PANEL_VERSION}}"></div>

<div id="wrapper">
  <div class="content-wrapper">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>
  <a href="javaScript:void(0);" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
</div><div id="toast-helper" data-toast="{{json_encode([])}}"></div>


<script src="{{asset('dashboard/js/app.js')}}"></script>
<script src="{{asset('dashboard/js/admin-main.js')}}"></script>


{!! \App\Panel\UiHandler\ScriptBuilder::build(\App\Panel\Models\Panel::class,$fields ) !!}
@yield("script")
</body>
</html>
