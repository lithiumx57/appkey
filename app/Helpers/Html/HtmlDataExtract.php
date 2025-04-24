<?php

namespace App\Helpers\Html;

class HtmlDataExtract
{
  public static function init($text): string|null
  {
    $text = ExtractLink::replaceLink($text);
    $text = ExtractTags::replaceTags($text);


    return  $text;
  }
}
