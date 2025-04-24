<?php

namespace App\Helpers\Html;

class ExtractTags
{
  public static function replaceTags($text): string
  {
    $pattern = '/#([\p{L}0-9_]+)/u';
    $replacement = '<a target="_blank" class="link-mode" href="/tags/$1">#$1</a>';
    return preg_replace($pattern, $replacement, $text);
  }
}
