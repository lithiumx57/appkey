<?php


namespace App\Panel\helpers;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class ZipHelper
{
  public static function createArchive($savePath, $dirPath)
  {
    $zip = new ZipArchive();
    $zip->open($savePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($dirPath),
      RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file) {
      if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($dirPath) + 1);
        $zip->addFile($filePath, $relativePath);
      }
    }

    $zip->close();
  }


  public static function addToArchive($zipPath, array $files, $deleteAfterAdd = false, $description = "LiMaster")
  {

    $zip = new ZipArchive();
    $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    foreach ($files as $key => $value) {
      if (is_numeric($key)) {
        $file = $value;
        $name = XFileHelper::getFileName($value);
      } else {
        $file = $key;
        $name = $value;
      }
      $zip->addFile($file, $name);
    }

    $zip->setArchiveComment($description);
    $zip->close();

    if ($deleteAfterAdd) {
      foreach ($files as $key => $value) {
        if (is_numeric($key)) {
          $file = $value;
        } else {
          $file = $key;
        }
        $file = XStringHelper::deleteStartIndex($file);
        unlink($file);
      }
    }

  }

}
