<!DOCTYPE html>
<html lang="fa" id="html">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">
    <title>@isset($pageTitle) {{$pageTitle}} @else پنل مدیریت @endif</title>
    <link rel="stylesheet" href="{{asset('dashboard/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/admin-style.css')}}">
    {!! \App\Panel\UiHandler\StyleBuilder::build($model) !!}
    @yield('style')
</head>
<body class="bg-theme bg-theme2">
<div id="x-helpers"
     data-admin-prefix="{{getConfigurator()->prefix()}}"
     data-route="{{$route}}"
     data-is-trash-mode="{{isTrashMode()}}"
     data-use-x-table="@isset($model){{$model::$xTable}}@endisset"
></div>

<div id="wrapper">
    {!! \App\Panel\UiHandler\XPopup::render() !!}
    <div class="container-fluid" style="margin-bottom: 35px">
        @yield('content')
    </div>
    <a href="javaScript:void(0);" class="back-to-top" style="bottom: 50px"><i class="fa fa-angle-double-up"></i> </a>
    {{--  @include('categories.layouts.index-popup-options')--}}
</div>

<script src="{{asset('dashboard/js/app.js')}}"></script>
<script src="{{asset('dashboard/js/admin-main.js')}}"></script>
{{--<script src="{{asset('dashboard/js/admin.js')}}"></script>--}}

<script>
  var flashAlert = JSON.parse('{!! getFlashAlert() !!}');
  if (flashAlert["title"] != null) {
    Swal.fire({
      title: flashAlert["title"],
      type: flashAlert["kind"],
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'بسیار خب',
    }).then((result) => {
    });
  }
  // $(function () {
  //   $(".knob").knob();
  // });
</script>
{{--@include('layouts.notifications')--}}
{!! \App\Panel\UiHandler\ScriptBuilder::build($model) !!}
@yield('script')
@yield('custom')

</body>
</html>
