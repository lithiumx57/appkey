<?php
$isXModel = \App\Panel\helpers\ModelHelper::isXModel(\App\Models\User::class);
?>



@if(!$isXModel)
  <div>
    مدل User برای استفاده از پنل مدیریت نیاز به تغییرات دارد
    <a class="btn btn-primary" href="{{buildDashboardPath("panel?type=user-model")}}">تغییر</a>
  </div>
@endif

