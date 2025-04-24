<?php


namespace App\Panel\helpers;


use Illuminate\Support\Str;

class XStringHelper
{

  public static function startWith($string, $start): bool
  {
    $len = Str::length($start);
    return Str::substr($string, 0, $len) == $start;
  }


  public static function isLink($string): bool
  {
    return preg_match('/\b((http|https|ftp):\/\/[a-z0-9-]+(\.[a-z0-9-]+)+([\/?].*)?)\b/i', $string) === 1;
  }

  public static function isEmail($str): bool
  {
    return filter_var($str, FILTER_VALIDATE_EMAIL);
  }

  public static function hasString($string, $search): bool
  {
    if ($search == null) {
      return false;
    }
    return !!strpos(" " . $string, $search);
  }

  public static function deleteStartIndex($path, string $char = "/")
  {
    if (self::startWith($path, $char)) {
      return substr($path, 1, strlen($path) - 1);
    }
    return $path;
  }

  public static function detectHashtags($text)
  {
    return preg_replace("/(#.*?(\s|$))/", '<span class="hashtag">$1</span>', $text);
  }


  public static function detectLink($text)
  {
    return preg_replace("/(((ht|f)tp(s|)):\/\/[a-zA-Z0-9-\.].+\..*?(\s|$))/", '<a href="$1" rel="nofollow" class="text-link">' . translate('لینک') . ' </a>', $text);
  }

  public static function initText($text)
  {
    $text = self::detectHashtags($text);
    $text = self::detectLink($text);
    return $text;
  }

  public static function isValidMobilePhone(string $string): bool
  {
    if (strlen($string) != 11) {
      return false;
    }
    return true;

  }

  public static function getLastIndex($string, string $seperator = "/")
  {
    $result = explode($seperator, $string);
    return $result[count($result) - 1];
  }

  public static function convertStringToNumber($string): int
  {
    $result = Str::replace(",", "", $string);
    return (int)$result;
  }

  public static function isWebsite($string)
  {
    return true;
    return preg_match("/((http(s|))://|www\.|).+\..+/", " " . $string);
  }

  public static function isValidString($string)
  {
    return preg_match("/[a-zالف-ی]/", $string);
  }


}
