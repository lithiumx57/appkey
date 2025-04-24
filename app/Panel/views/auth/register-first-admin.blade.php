
<table class="table table-bordered">
  <tr>
    <th>کتابخانه های استفاده شده در پنل</th>
  </tr>

  <tr>
    <?php


    $hasClass = false;
    try {

      $a = new ReflectionClass(Intervention\Image\Image::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>

    <th
      style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">
      composer require intervention/image
    </th>
  </tr>
  <tr>
    <?php


    $hasClass = false;
    try {

      $a = new ReflectionClass(Cviebrock\EloquentSluggable\Sluggable::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>

    <th
      style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">
      composer require cviebrock/eloquent-sluggable
    </th>
  </tr>

  <tr>
    <?php
    $hasClass = false;
    try {
      $a = new ReflectionClass(Pusher\Pusher::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }


    ?>

    <th
      style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">
      composer require pusher/pusher-php-server
    </th>
  </tr>

  <tr>
    <?php
    $hasClass = false;
    try {

      $a = new ReflectionClass(Livewire\Component::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>
    <th
      style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">
      composer require livewire/livewire
    </th>
  </tr>


  <style>
    .card-authentication1{
      width: 33rem !important;
      max-width: 33rem !important;
    }
  </style>
</table>


<div class="card-title text-uppercase text-center pt-2 pb-2">ثبت اولین ادمین</div>

<form action="{{buildRoute("register-first-user")}}" method="post" dir="rtl">
  @csrf
  <div class="form-group">
    <label for="exampleInputUsername" class="sr-only">نام</label>
    <div class="position-relative has-icon-right">
      <input type="text" id="exampleInputUsername"
             name="name"
             style="padding-left: 44px"
             class="form-control input-shadow" placeholder="نام">
      <div class="form-control-position">
        <i class="fa fa-user"></i>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputUsername" class="sr-only">نام کاربری</label>
    <div class="position-relative has-icon-right">
      <input type="text" id="exampleInputUsername"
             name="username"
             style="padding-left: 44px"
             class="form-control input-shadow" placeholder="نام کاربری">
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
             class="form-control input-shadow" placeholder="رمز عبور">


      <div class="form-control-position">
        <i class="icon-lock"></i>
      </div>
    </div>


  </div>
 <div class="form-group">
    <label for="exampleInputPassword" class="sr-only">کلمه عبور</label>
    <div class="position-relative has-icon-right">
      <input type="password" id="exampleInputPassword"
             style="padding-left: 44px"
             name="confirm-password"
             class="form-control input-shadow" placeholder="تکرار کلمه عبور">


      <div class="form-control-position">
        <i class="icon-lock"></i>
      </div>
    </div>


  </div>

  <input type="submit" class="btn btn-light btn-block" value="ثبت اولین ادمین">
</form>
