<?php

namespace App\Panel\UiHandler\Theme;

use App\Panel\Models\Background;

class ThemeManagement
{
  public static function getDefaultdata()
  {
    return [
      "blur" => "100",
      "color" => "#fff",
      "accent" => "#fff",
//      "dialogBackground" => "#222",
//      "dialogColor" => "#fff",
      "placeHolderColor" => "#fff",
    ];
  }

  public static function getStyles()
  {
    $cache = cache()->get("theme", self::getDefaultdata());
//    $cache = self::getDefaultdata();

    $color = @$cache["color"];
    $colorAccent = @$cache["accent"];
    $blur = @$cache["blur"];
    $placeholder = @$cache["placeHolderColor"];

    $dialogBackground = @$cache["dialogBackground"];
    $dialogColor = @$cache["dialogColor"];

    $result = "<style>
      body{
        background-image: url(" . self::getBg() . " ) !important;
        backdrop-filter: blur(" . $blur . "px" . ");
        color: " . $color . ";
      }
      i,label,span,.logo-text,#menu-search-input{
        color: " . $color . ";
      }

      input{
        color: " . $color . "!important;
      }

      .menu i,.fa{
        color: " . $colorAccent . ";
      }

      .icheck-material-success > input:first-child:checked + input[type='hidden'] + label::before, .icheck-material-success > input:first-child:checked + label::before {
          background-color: $colorAccent;
          border-color: $colorAccent;
      }


      .icheck-material-success > input:first-child {
          background-color: $colorAccent;
      }

      .icon-menu {
          color: $colorAccent !important;
      }


      ::placeholder{
        color: " . $placeholder . "!important;
      }
      .form-control{
            color: " . $color . "!important;
      }
      .dz-default.dz-message span{
        color: #000;
      }

    </style>";

//    $result = "background-image:url(" . self::getBg() . ");backdrop-filter:blur(" . $cache["blur"] . "px" . ")";
    return $result;
  }


  private static function getBg()
  {
    $user = auth()->user();
    $bg = $user->background_id;
    if ($bg == 0) return self::defaultBackground();
    $background = Background::find($bg);
    if ($background == null) return self::defaultBackground();
    $background = $background->path;
    if (!file_exists($background)) return self::defaultBackground();
    return "/" . $background;
  }

  private static function defaultBackground()
  {
    return "/dashboard/images/bg-themes/2.png";
  }
}
