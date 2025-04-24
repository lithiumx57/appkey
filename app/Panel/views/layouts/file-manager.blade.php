@extends('layouts.main')

@section('style')

  <link rel="stylesheet" href="{{asset('dashboard/libs/file-manager/css/elfinder.min.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/libs/file-manager/css/theme.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/css/jquery-ui.min.css')}}">


@endsection

@section('content')
  <div class="col-xl-9 col-md-12"  style="margin: auto;padding-top: 8px;padding-bottom: 8px">
    <div id="filemanager"></div>
  </div>
@endsection



@section('script')
  <script src="{{asset('dashboard/js/jquery-ui.min.js')}}"></script>
  <script src="{{asset('dashboard/libs/file-manager/js/elfinder.min.js')}}"></script>
  <script src="{{asset('dashboard/libs/file-manager/js/i18n/elfinder.fa.js')}}"></script>
  <script>
    $(function () {
      $("#filemanager").elfinder({
        height: 600,
        cssAutoLoad: false,
        url: '{{url('dashboard/libs/file-manager/php/connector.minimal.php')}}',
        'lang': "fa"
      })
    })
  </script>

@endsection