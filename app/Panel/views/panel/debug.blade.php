<?php

use Illuminate\Support\Facades\Schema;

if (!is_dir(public_path("dashboard"))) {
  echo "در حال نصب لطفا صبر کنید";
  header('Location: ' . '/panel?type=publish-x-admin');
  exit;
}
?>

@extends('layouts.main')
@section('style')
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
@endsection
@section('content')

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
        جدول های سطوح دسترسی ایجاد نشده است .. <a class="btn btn-primary"
                                                  href="{{buildDashboardPath("panel?type=roles")}}">ایجاد</a>
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

{{--    <?php--}}

{{--    $result = Schema::hasTable('onlines');--}}
{{--    if ($result == false) {--}}
{{--      $errorCounter++;--}}
{{--      ?>--}}
{{--    <tr>--}}
{{--      <td>--}}
{{--        جدول های کاربران آنلاین پنل ایجاد نشده است .. <a class="btn btn-primary"--}}
{{--                                                         href="{{buildDashboardPath("panel?type=onlines")}}">ایجاد</a>--}}
{{--      </td>--}}
{{--    </tr>--}}
{{--    <?php } ?>--}}

    <?php
    $result = Schema::hasTable('notifications');
    if ($result == false) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        جدول اعلان ها ساخته نشده است
        <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=notifications")}}">ساختن</a>
      </td>
    </tr>
    <?php } ?>


    <?php

    $result = Schema::hasTable('attachments');
    if ($result == false) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        جدول های پیوست ها ایجاد نشده است ..
        <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=attachments")}}">ایجاد</a>
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
        جدول عنوان و توضیحات صفحات ایجاد نشده است <a class="btn btn-primary"
                                                     href="{{buildDashboardPath("panel?type=heads")}}">
          ایجاد</a>
      </td>
    </tr>
    <?php } ?>


    <?php
    $result = Schema::hasTable('themes');
    if ($result == false) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        جدول تم ها ثبت نشده است
        <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=themes")}}">
          ایجاد</a>
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
    $result = \App\Panel\helpers\ModelHelper::isXModel(\App\Models\User::class);
    if (!$result) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        مدل User برای استفاده از پنل مدیریت نیاز به تغییرات دارد<a class="btn btn-primary"
                                                                   href="{{buildDashboardPath("panel?type=user-model")}}">تغییر</a>
      </td>
    </tr>
    <?php } ?>


    <?php
    $result = Schema::hasTable('tags');
    if (!$result) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        جدول تگ ها ایجاد نشده است <a class="btn btn-primary"
                                     href="{{buildDashboardPath("panel?type=tags")}}">
          ایجاد</a>
      </td>
    </tr>
    <?php } ?>


    <?php
    if (!is_dir(lang_path("fa"))) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        پوشه فارسی در زبان ها وجود ندارد <a class="btn btn-primary"
                                            href="{{buildDashboardPath("panel?type=add-fa")}}">افزودن</a>
      </td>
    </tr>
    <?php } ?>

      <!--    --><?php
                 //    $result = Schema::hasTable('logs');
                 //    if ($result == false) {
                 //    $errorCounter++;
                 //    ?><!---->
    {{--    <tr>--}}
    {{--      <td>--}}
    {{--        جدول لاگ ایجاد نشده است در صورت نیاز ... ایجاد کنید<a class="btn btn-primary" href="{{buildDashboardPath("panel?type=logs")}}"> ایجاد</a>--}}
    {{--      </td>--}}
    {{--    </tr>--}}
    <?php //} ?>

    <?php
    $result = Schema::hasTable('languages');
    if ($result == false) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        جدول زبان ها ایجاد نشده است در صورت نیاز ... ایجاد کنید<a class="btn btn-primary"
                                                                  href="{{buildDashboardPath("panel?type=languages")}}">
          ایجاد</a>
      </td>
    </tr>
    <?php } ?>


    <?php
    $result = Schema::hasTable('owns');
    if ($result == false) {
      $errorCounter++;
      ?>
    <tr>
      <td>
        جدول owns ایجاد نشده است در صورت نیاز ... ایجاد کنید<a class="btn btn-primary"
                                                               href="{{buildDashboardPath("panel?type=owns")}}">
          ایجاد</a>
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


  </table>
@endsection
