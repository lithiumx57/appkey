<?php

namespace App\Helpers\StaticData;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;

class Menus
{
  private static function getPlatforms(): array
  {
    $result = AttributeValue::where(['attribute_id' => Attribute::PLATFORM_ID])->get();
    $records = [];
    foreach ($result as $value) {
      $records[] = [
        "id" => $value->id,
        "title_fa" => $value->title_fa,
        "title_en" => $value->title_en,
        "link" => "/platforms/" . $value->slug,
      ];
    }
    return $records;
  }

  private static function getPingMenus(): array
  {
    $records = [];
    $result = Product::where("category_id", Category::PING_ID)->get();
    foreach ($result as $value) {
      $records[] = [
        "id" => $value->id,
        "title_fa" => $value->name_fa,
        "title_en" => $value->name_en,
        "link" => "/products/" . $value->slug,
      ];
    }
    return $records;
  }

  public static function getAll(): array
  {

    return [
      [
        "title" => "بازی های اورجینال pc",
        "link" => "/pc-original-games",
        "class" => "pc-original-games",
        "submenus" => self::getPlatforms()
      ],

      [
        "title" => "سرویس کاهش پینگ",
        "link" => "/ping-reduction-service",
        "class" => "ping-reduction-service",
        "submenus" => self::getPingMenus()
      ],


    ];
  }
}

