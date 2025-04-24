<?php

namespace App\Infrastructure\Validation;

use App\Panel\helpers\XStringHelper;
use Exception;
use Illuminate\Support\Str;

class Validation
{

  public static function getInstance(): Validation
  {
    return new Validation();
  }

  /**
   * @throws Exception
   */
  public function validateLink($string = null, $name = null, $required = true): void
  {
    if (($string == null || !is_string($string) || $string == "" || Str::length(trim($string)) < 1)) {
      if ($required) throw new Exception("وارد کردن " . $name . " الزامی است");
      else return;
    }

    if (Str::length($string) < 6) throw new Exception($name . " نباید کمتر از  " . 6 . " کاراکتر باشد ");
    if (Str::length($string) > 600) throw new Exception($name . " نباید بیشتر از  " . 600 . " کاراکتر باشد ");
    if (!XStringHelper::isLink($string)) throw new Exception("لینک " . $name . " اشتباه وارد شده است ");
  }

  /**
   * @throws Exception
   */
  public function validateString($string = null, $name = null, $min = 2, $max = 100000, $equals = null, $required = true): void
  {

    if (($string == null || !is_string($string) || $string == "" || Str::length(trim($string)) < 1)) {
      if ($required) {
        throw new Exception("وارد کردن " . $name . " الزامی است");
      } else {
        return;
      }
    }

    if ($equals && Str::length($string) !== $equals) {
      throw new Exception($name . " باید  " . $equals . " کاراکتر باشد ");
    }

    if (Str::length($string) < $min) {
      throw new Exception($name . " نباید کمتر از  " . $min . " کاراکتر باشد ");
    }

    if (Str::length($string) > $max) {
      throw new Exception($name . " نباید بیشتر از  " . $max . " کاراکتر باشد ");
    }

  }

  /**
   * @throws Exception
   */
  public function validateEmail($string = null, $name = null, $min = 2, $max = 100, $required = true): void
  {
    if (!is_string($string) && !$required) return;
    if (is_string($string) && mb_strlen(trim($string)) == 0 && !$required) return;


    if (!XStringHelper::isEmail($string)) {
      throw new Exception("قالب " . $name . " اشتباه است ");
    }

    if (Str::length($string) < $min) {
      throw new Exception($name . " نباید کمتر از  " . $min . " کاراکتر باشد ");
    }

    if (Str::length($string) > $max) {
      throw new Exception($name . " نباید بیشتر از  " . $max . " کاراکتر باشد ");
    }

  }


  /**
   * @throws Exception
   */
  public function validateArray($category, $name, $isSelectArray = false, $required = true): void
  {
    if (!is_array($category) || count($category) == 0) {
      if (!$required) return;
      throw new Exception("وارد کردن " . $name . " الزامی است ");
    }

    if ($isSelectArray && !@$category[0]["value"]) throw new Exception("وارد کردن " . $name . " الزامی است ");
  }

  /**
   * @throws Exception
   */
  public function validateMobile($mobile, $name, $required = true): void
  {

    if (!$required){
      if (!$mobile || strlen(trim($mobile))==0){
        throw new Exception("وارد کردن " . $name . " الزامی است ");
      }
    }

    if (!preg_match("/^(?:98|\+98|0098|0)?9[0-9]{9}$/", $mobile)) {
      throw new Exception($name." وارد شده اشتباه است ");
    }

  }

  /**
   * @throws Exception
   */
  public function validateRequired($data, $name): void
  {
    if (is_string($data)) {
      if (strlen(trim($data)) == 0) {
        throw new Exception($name . " الزامی است ");
      }
    } else if (is_null($data)) {
      throw new Exception($name . " الزامی است ");
    } else if (is_array($data)) {
      if (count($data) == 0) {
        throw new Exception($name . " الزامی است ");
      }
    }
  }


  /**
   * @throws Exception
   */
  public function validateBase64Image($image, $name, $required = true, $maxSize = 2048): void
  {
    if (!$required) {
      return;
    }

    $extensions = [
      "image/png",
      "image/jpg",
      "image/jpeg",
    ];

    $decoded = getimagesize($image);

    if (!$decoded) {
      throw new Exception($name . " نامعتبر است ");
    }


    if (!hasIndex($extensions, @$decoded["mime"])) {
      throw new Exception($name . " نامعتبر است ");
    }

    $size = (int)(Str::length(rtrim($image, '=')) * 0.75) / 1024;
    if ($size > $maxSize) {
      throw new Exception($name . " خیلی بزرگ است ");
    }


  }

  /**
   * @throws Exception
   */
  public function validateBase64File($image, $name, $required = true, $maxSize = 2048): string
  {

    $extensions = [
      "Application/pdf",
      "image/png",
      "image/jpg",
      "image/jpeg",
    ];

    $decoded = getimagesize($image);

    $mime = "";

    if (!$decoded) {
      if (!XStringHelper::startWith($image, "data:application/pdf")) throw new Exception($name . " نامعتبر است ");
      $mime = "pdf";
    } else {
      if (!hasIndex($extensions, @$decoded["mime"])) throw new Exception($name . " نامعتبر است ");
      $mime = $decoded["mime"];
    }


    $size = (int)(Str::length(rtrim($image, '=')) * 0.75) / 1024;
    if ($size > $maxSize) {
      throw new Exception($name . " خیلی بزرگ است ");
    }

    return $mime;

  }

  /**
   * @throws Exception
   */
  public function validateNumber($number, $name, $min = 0, $max = PHP_INT_MAX): void
  {
    if (is_null($number)) {
      throw new Exception($name . " الزامی است ");
    }
    $number = str_replace(",", "", $number);

    if (!is_numeric($number)) throw new Exception($name . " الزامی است ");

    if ($number < $min) throw new Exception($name . " نباید کمتر از  " . number_format($min) . " باشد ");

    if ($number > $max) throw new Exception($name . " نباید بیشتر از  " . number_format($max) . " باشد ");


  }


}
