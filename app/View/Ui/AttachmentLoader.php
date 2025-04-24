<?php

namespace App\View\Ui;

use App\Panel\helpers\XMediaBuilder;
use App\Panel\Models\Attachment;

class AttachmentLoader
{

  private static function load($records, $type): string|null
  {
    if (!is_array($records)) {
      $records = [];
    }
    $result = null;
    if (count($records) > 0) {
      $result = '<source type="' . $type . '"';
      $i = 0;
      foreach ($records as $size => $value) {
        $i++;
        if ($i == 1) {
          $result .= ' srcset="';
        }

        $result .= $value ;
        if (count($records) > $i) $result .= ',';
      }
      $result .= '"/>';
    }
    return $result;
  }

  public static function buildHtml(Attachment|null $attachment, $size, $extensions, $uploadPath, $fileName): string|null
  {


    foreach ($extensions as $extension) {
      $extension = strtolower($extension);
      $extension = str_replace("jpeg", "jpg", $extension);
      $records[$extension][$size] = XMediaBuilder::init($attachment, $size, $extension, $uploadPath, $fileName);
    }

    $result = '<picture>';
    $webps = @$records["webp"];
    $jpgs = @$records["jpg"];
    $pngs = @$records["png"];

    $loadedWebp = self::load($webps, "image/webp");
    $loadedJpeg = self::load($jpgs, "image/jpeg");
    $loadedPngs = self::load($pngs, "image/png");

    if ($loadedJpeg) $result .= $loadedJpeg;
    if ($loadedWebp) $result .= $loadedWebp;
    if ($loadedPngs) $result .= $loadedPngs;


    $result .= self::buildMain($webps[$size], $size . "px");
    $result .= '</picture>';
    return $result;
  }


  private static function buildMain($default, $size): string
  {
    return '<img src="' . $default . '" width="' . $size . '"/>';
  }


}
