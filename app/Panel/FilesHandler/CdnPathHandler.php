<?php

namespace App\Panel\FilesHandler;

use App\Panel\helpers\XFileHelper;
use App\Panel\helpers\XStringHelper;

class CdnPathHandler
{
  public static function mkdirs($absolutePath)
  {
    $absolutePath = str_replace("\\", "/", $absolutePath);
    $cdnDir = getConfigurator()->getCdnDir();
    if ($cdnDir) {
      $shouldMake = str_replace($cdnDir, "", $absolutePath);
    } else {
      $absolutePath = XFileHelper::initPath($absolutePath);
      $cdnDir = public_path();
      if (XStringHelper::hasString($absolutePath, public_path())) $shouldMake = str_replace(public_path(), "", $absolutePath);
      else $shouldMake = $absolutePath;
    }


    $shouldMake = str_replace("\\", "/", $shouldMake);
    $cdnDir = str_replace("\\", "/", $cdnDir);
    $shouldMake = str_replace($cdnDir, "", $shouldMake);
    $paths = explode("/", $shouldMake);
    $temp = null;

    foreach ($paths as $row) {

      if ($row == null) continue;
      if ($temp == null) $shouldMake = $cdnDir . "/" . $row;
      else $shouldMake = $temp . "/" . $row;
      $temp = $shouldMake;



      try {
        if (!is_dir($shouldMake)) mkdir(str_replace("/", DIRECTORY_SEPARATOR, $shouldMake));
      }catch (Error|Exception $exception){
        dd($exception->getMessage());
      }
    }
  }
}
