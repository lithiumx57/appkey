<?php

namespace App\Panel\Requests\Handler;

class XSort
{

  public static function initialize(): array
  {
    $data = getXRequest("data");
    $model = getXRequest("model");

    $model = str_replace("/", "\\", $model);
    $roles = getXRequest("roles");
    $roles = json_decode($roles, true);
    $sortField = getXRequest("sortField");

    foreach ($data as $key => $row)
      $model::where($roles)->where(['id' => $row])->update([$sortField => $key]);
    return ['status' => true];
  }

}
