<?php

use App\Panel\Sms\KavehNegar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

if (!is_dir(public_path("dashboard"))) {
  echo "در حال نصب لطفا صبر کنید";
  header('Location: ' . buildRoute('panel?type=publish-x-admin'));
  exit;
}
?>


<style>
    #update-panel {
        display: none;
    }

    #update-panel.active {
        display: inline-block;
    }

    #status {
        display: none;
    }

    #status.active {
        display: inline-block;
    }
</style>

<table class="table table-bordered">
  <tr>
    <td>عنوان خطا</td>
  </tr>
  <tr>
    <td>
      <span id="" style="color: #0af172">ورژن پنل :  {{PANEL_VERSION}}</span>
      <button id="update-panel" class="btn btn-success btn-sm">به روز رسانی</button>
      <span id="status"></span>
      {{--        <a href="/{{getAdminPrefix()}}/panel?type=update" id="update">به روز رسانی</a>--}}
    </td>
  </tr>
  <?php
  $errorCounter = 0;
  ?>

  <?php

  $result = Schema::hasTable('roles');
  if ($result == false) {
    $errorCounter++;
    ?>
  <tr>
    <td>
      جدول های سطوح دسترسی ایجاد نشده است .. <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=roles")}}">ایجاد</a>
    </td>
  </tr>
  <?php } ?>

  <?php

  $result = Schema::hasTable('panel_models');
  if ($result == false) {
    $errorCounter++;
    ?>
  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        جدول های کانفیگ های پنل ایجاد نشده است .. <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=panel-models")}}">ایجاد</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}
  <?php } ?>



  <?php

  $result = Schema::hasTable('onlines');
  if ($result == false) {
    $errorCounter++;
    ?>
  <tr>
    <td>
      جدول های کاربران آنلاین پنل ایجاد نشده است .. <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=onlines")}}">ایجاد</a>
    </td>
  </tr>
  <?php } ?>

  <?php

  $result = Schema::hasTable('panel_menus');
  if ($result == false) {
    $errorCounter++;
    ?>
  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        جدول های منو های پنل ایجاد نشده است .. <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=panel-menus")}}">ایجاد</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}
  <?php } ?>


  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=update-menus")}}">به روز رسانی منو ها</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}



  <?php
  $result = Schema::hasTable('heads');
  if ($result == false) {
    $errorCounter++;
    ?>
  <tr>
    <td>
      جدول عنوان و توضیحات صفحات ایجاد نشده است <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=heads")}}"> ایجاد</a>
    </td>
  </tr>
  <?php } ?>


  {{--    <?php--}}
  {{--    $result = Schema::hasTable('messages');--}}
  {{--    if ($result == false) {--}}
  {{--    $errorCounter++;--}}
  {{--    ?>--}}
  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        جدول های پیام رسانی ایجاد نشده است در صورت لزوم می توانید آنها را ایجاد کنید .. <a class="btn btn-primary" href="/{{getAdminPrefix()}}/panel?type=messages">ایجاد</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}
  {{--    <?php } ?>--}}
  {{--    --}}

  <?php
  $result = Schema::hasTable('sms_messaging');
  if ($result == false) {
    $errorCounter++;
    ?>
  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        در صورتی که می خواهید پیام رسانی سیمکارتی را در برنامه خود داشته باشید جدول آن را اضافه کنید <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=sms_messages")}}">ایجاد</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}
  <?php } ?>


  <?php
  $result = \App\Panel\helpers\ModelHelper::isXModel(\App\Models\User::class);
  if (!$result) {
    $errorCounter++;
    ?>
  <tr>
    <td>
      مدل User برای استفاده از پنل مدیریت نیاز به تغییرات دارد<a class="btn btn-primary" href="{{buildDashboardPath("panel?type=user-model")}}">تغییر</a>
    </td>
  </tr>
  <?php } ?>


  <?php
  if (!is_dir(lang_path("fa"))) {
    $errorCounter++;
    ?>
  <tr>
    <td>
      پوشه فارسی در زبان ها وجود ندارد <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=add-fa")}}">افزودن</a>
    </td>
  </tr>
  <?php } ?>

  {{--    <?php--}}
  {{--    $result = Schema::hasTable('logs');--}}
  {{--    if ($result == false) {--}}
  {{--    $errorCounter++;--}}
  {{--    ?>--}}
  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        جدول لاگ ایجاد نشده است در صورت نیاز ... ایجاد کنید<a class="btn btn-primary" href="{{buildDashboardPath("panel?type=logs")}}"> ایجاد</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}
  {{--    <?php } ?>--}}

  <?php
  $result = Schema::hasTable('languages');
  if ($result == false) {
    $errorCounter++;
    ?>
  {{--    <tr>--}}
  {{--      <td>--}}
  {{--        جدول زبان ها ایجاد نشده است در صورت نیاز ... ایجاد کنید<a class="btn btn-primary" href="{{buildDashboardPath("panel?type=languages")}}"> ایجاد</a>--}}
  {{--      </td>--}}
  {{--    </tr>--}}
  <?php } ?>


  <?php
  $result = Schema::hasTable('owns');
  if ($result == false) {
    $errorCounter++;
    ?>
  <tr>
    <td>
      جدول owns ایجاد نشده است در صورت نیاز ... ایجاد کنید<a class="btn btn-primary" href="{{buildDashboardPath("panel?type=owns")}}"> ایجاد</a>
    </td>
  </tr>
  <?php } ?>




  @if($errorCounter==0)
    <tr>
      <td>
        هیچ خطایی وجود ندارد
      </td>
    </tr>
  @endif


  <tr>
    <th>کتابخانه های استفاده شده در پنل</th>
  </tr>

  <tr>
    <?php


    $hasClass = false;
    try {
      $a = new ReflectionClass(Intervention\Image\Facades\Image::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>

    <th style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">composer require intervention/image</th>
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

    <th style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">composer require pusher/pusher-php-server</th>
  </tr>

  <tr>
    <?php
    $hasClass = false;
    try {
      $a = new ReflectionClass(Artesaos\SEOTools\Facades\SEOTools::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    /*php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"*/
    ?>
    <th style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">composer require artesaos/seotools</th>

  </tr>

  <tr>
    <?php
    $hasClass = false;
    try {
      $a = new ReflectionClass(Morilog\Jalali\Jalalian::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>
    <th style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">composer require morilog/jalali</th>
  </tr>

  <tr>
    <?php
    $hasClass = false;
    try {

      $a = new ReflectionClass(Kavenegar\KavenegarApi::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>
    <th style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">composer require kavenegar/laravel</th>
  </tr>

  <tr>
    <?php
    $hasClass = false;
    try {

      $a = new ReflectionClass(\Webklex\IMAP\Facades\Client::class);
      $hasClass = true;
    } catch (Exception $e) {
      $hasClass = false;
    }
    ?>
    <th style="@if(!$hasClass) color: #e5b800 @else color: #0af172 @endif ;text-align: left;direction: ltr">composer require webklex/laravel-imap</th>
  </tr>
</table>
