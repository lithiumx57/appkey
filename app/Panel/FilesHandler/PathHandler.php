<?php

namespace App\Panel\FilesHandler;

use App\Panel\helpers\XFileHelper;
use App\Panel\helpers\XStringHelper;

class PathHandler
{
  public static function mkdirs($absolutePath)
  {
    $absolutePath = XFileHelper::initPath($absolutePath);
    if (XStringHelper::hasString($absolutePath, base_path())) $shouldMake = str_replace(base_path(), "", $absolutePath);
    else $shouldMake = $absolutePath;
    $paths = explode(DIRECTORY_SEPARATOR, $shouldMake);
    $temp = null;
    foreach ($paths as $row) {
      if ($row == null) continue;
      if ($temp == null) $shouldMake = base_path($row);
      else $shouldMake = $temp . DIRECTORY_SEPARATOR . $row;
      $temp = $shouldMake;
      if (!is_dir($shouldMake)) mkdir($shouldMake);
    }
  }
}
