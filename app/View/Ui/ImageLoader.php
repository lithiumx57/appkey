<?php

namespace App\View\Ui;

class ImageLoader
{

  private static function load($records, $type): string|null
  {
    $result = null;
    if (count($records) > 0) {
      $result = '<source type="' . $type . '"';
      $i = 0;
      foreach ($records as $size => $value) {
        $i++;
        if ($i==1){
          $result .= ' srcset="';
        }

        $result .= $value . ' ' . $size . 'w';
        if (count($records) > $i) $result .= ',';
      }
      $result .= '"/>';
    }
    return $result;
  }

  public static function buildHtml($prefix, $paths, $default): string|null
  {
    if ($paths == null) return null;

    $result = '<picture>';
    $webps = self::getExtenion($prefix, $paths, ["webp"]);
    $jpgs = self::getExtenion($prefix, $paths, ["jpg", "jpeg"]);

    $loadedWebp = self::load($webps, "image/webp");
    $loadedJpeg = self::load($jpgs, "image/jpeg");

    if ($loadedJpeg) $result .= $loadedJpeg;
    if ($loadedWebp) $result .= $loadedWebp;

    $result .= self::buildMain($prefix, $paths, $default);

    $result .= '</picture>';
    return $result;
  }


  private static function buildMain($prefix, $paths, $default):string
  {
    $default = $paths[$default];
    return '<img src="' . $prefix . $default . '"/>';
  }

  private static function getExtenion($prefix, $paths, $extensions): array
  {
    $records = [];
    foreach ($paths as $key => $value) {
      $size = explode("_", $key)[0];
      $keyExtension = explode("_", $key)[1];
      $hasExtension = false;
      foreach ($extensions as $extension) if (mb_strpos(" " . $extension, $keyExtension)) $hasExtension = true;
      if ($hasExtension) $records[$size] = $prefix . $value;
    }
    return $records;
  }


}
