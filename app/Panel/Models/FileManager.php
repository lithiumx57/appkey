<?php


namespace App\Panel\Models;


use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;

class FileManager extends LiModel
{
  public bool $isTableOff = true;
  protected ?string $pluralTitle = "مدیریت فایل";
  public bool $menuOff = true;

  public static array $customPermissions = [
    "access-panel-filemanager" => "دسترسی به مدیریت فایل پنل"
  ];




  public static function disable():XDisable
  {
    return xDisable()->index()->delete()->edit()->create();
  }

}
