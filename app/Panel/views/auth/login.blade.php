<!DOCTYPE html>
<html lang="fa" id="html">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <link rel="icon" href="data:;base64,=">
  <meta name="csrf-token" content="{{ csrf_token() }}" id="csrf">
  <title>ورود به داشبورد</title>
  <link rel="stylesheet" href="{{asset('dashboard/css/app.css')}}"/>
</head>

<body class="bg-theme {{\App\Panel\UiHandler\ThemeManager::getThemeClass()}}" style="padding-top:
 120px">


<div id="wrapper" dir="ltr">
  <div class="card card-authentication1 mx-auto" style="padding: 0 !important;margin: 0">

    @if($errors->any())
      <div class="alert alert-danger" style="padding: 8px 24px;margin: 0 !important;">
        {!! implode('', $errors->all()) !!}
      </div>
    @endif
  </div>


  <div class="card card-authentication1 mx-auto my-1">

    <div class="card-body">
      <div class="card-content p-2">
        {!! \App\Panel\Auth\AuthExtraRender::renderLoginForm() !!}
      </div>


    </div>

  </div>

  <div style="direction: rtl;margin: auto;text-align: center;margin-top: 32px">
    {!! \App\Panel\Auth\AuthExtraRender::render() !!}
  </div>


</div>


</body>
</html>
