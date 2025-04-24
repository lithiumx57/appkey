<?php

namespace App\Panel\Requests\Handler;

use App\Panel\helpers\XJson;

class XUploader
{
  public static function initialize():array
  {

    $types = getXRequest("types");
    $file = request()->file("file");


    $extension = $file->getClientOriginalExtension();
    $types = XJson::decode($types);
    $isValid = false;

    foreach ($types as $type) {
      if ($type == $extension) {
        $isValid = true;
      }
    }

    if (!$isValid) {
      return [
        'status' => false,
        'message' => "فایل انتخاب شده غیر مجاز است"
      ];
    }


    $name = getXRequest("name");
    $path = getXRequest("path");


    if (!$name) {
      $name = time() . rand(0, 9999999) . "." . $file->getClientOriginalExtension();
    }

    if (!$path) {
      $path = "uploader";
    }

    $path = getConfigurator()->getUploadPrefix() . $path;

    if ($file->move($path, $name)) {
      return [
        'status' => true,
        'message' => "فایل با موفقیت آپلود شد",
        'path' => "/" . $path . "/" . $name
      ];
    } else {
      return [
        'status' => false,
        'message' => "خطا در آپلود فایل"
      ];
    }
  }
}
