<div class="card-title text-uppercase text-center py-3">ورود به داشبورد</div>


<form action="{{buildRoute("login")}}" method="post">
  @csrf
  <div class="form-group">
    <label for="exampleInputUsername" class="sr-only">نام کاربری</label>
    <div class="position-relative has-icon-right">
      <input type="text" id="exampleInputUsername"
             name="username"
             style="padding-left: 44px"
             class="form-control input-shadow" placeholder="Enter Username">
      <div class="form-control-position">
        <i class="fa fa-user"></i>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword" class="sr-only">کلمه عبور</label>
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

  <input type="submit" class="btn btn-light btn-block" value="ورود">
</form>
