<?php


namespace App\Panel\helpers;


class ToastHelper
{
  public static function toast($message, $kind = 'success')
  {
    $messageKey = "flash_message";
    $kindKey = "flash_message_kind";
    setSession($messageKey, $message);
    setSession($kindKey, $kind);
  }

  public static function getToastData()
  {
    $messageKey = "flash_message";
    $kindKey = "flash_message_kind";
    $title = getSession($messageKey);
    $kind = getSession($kindKey);
    removeSession($messageKey);
    removeSession($kindKey);
    return XJson::encode(["title" => $title, "kind" => $kind]);
  }

}
