<?php

namespace App\Helpers\Html;

class ExtractLink
{
  public static function replaceLink($text): string
  {
    $pattern = '/(?<!href=["\'])\b(?:https?:\/\/|www\.)[^\s<]+/i';
    $replacement = '<a href="$0" class="show-in-iframe link-mode" target="_blank">لینک</a>';
    return preg_replace($pattern, $replacement, $text);
  }

}
