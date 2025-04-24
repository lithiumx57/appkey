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
  <title>sign in to limaster dashboard</title>
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
        <div class="card-title text-uppercase text-center py-3">login To Dashboard</div>
        <form action="{{buildRoute("login")}}" method="post">
          @csrf
          <div class="form-group">
            <label for="exampleInputUsername" class="sr-only">username</label>
            <div class="position-relative has-icon-right">
              <input type="text" id="exampleInputUsername"
                     name="username"
                     style="padding-left: 44px"
                     class="form-control input-shadow" placeholder="Enter Username">
              <div class="form-control-position">
                <i class="icon-user"></i>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword" class="sr-only">Password</label>
            <div class="position-relative has-icon-right">
              <input type="password" id="exampleInputPassword"
                     style="padding-left: 44px"
                     name="password"
                     class="form-control input-shadow" placeholder="Enter Password">
              <div class="form-control-position">
                <i class="icon-lock"></i>
              </div>
            </div>
          </div>

          <input type="submit" class="btn btn-light btn-block" value="Sign In">
        </form>
      </div>
    </div>
  </div>


</div>


</body>
</html>
