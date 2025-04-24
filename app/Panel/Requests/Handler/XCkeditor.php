<?php

namespace App\Panel\Requests\Handler;

class XCkeditor
{

  public static function initialize()
  {
    $file = request()->file("upload");
    $imageName = time() . rand(1, 200) . "." . $file->getClientOriginalExtension();
    $path = "files/uploads/ck-image/";


    $file->move($path, $imageName);
    $message = getConfigurator()->getSuccessMessage();
    $cb = 1;

    $path = $path . $imageName;

    return [
      "uploaded" => 1,
      "fileName" => $imageName,
      "url"=>"/".$path,
//      "message" => getConfigurator()->getSuccessMessage(),
    ];

    return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('$cb', '" . $path . "', '$message');</script>";
  }
}
