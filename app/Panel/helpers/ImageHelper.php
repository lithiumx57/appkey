<?php


namespace App\Panel\helpers;


use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Mockery\Exception;

class ImageHelper
{



  public static function base64Decode($data)
  {
    return base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
  }

}
