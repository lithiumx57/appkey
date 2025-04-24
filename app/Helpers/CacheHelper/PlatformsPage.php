<?php

namespace App\Helpers\CacheHelper;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cache;
use App\Models\Product;
use App\Panel\Models\Attachment;
use Illuminate\Support\Facades\DB;

class PlatformsPage
{
  private static array|null $data = null;

  private static function getPlatforms(): array
  {
    $platforms = AttributeValue::getPlatforms();
    $records = [];
    foreach ($platforms as $platform) {
      $records[] = [
        "image" => buildAttachmentPaths(Attachment::find($platform->image), 280, ["webp", "jpg"], "platforms", $platform->slug),
        "title_fa" => $platform->title_fa,
        "title_en" => $platform->title_en,
        "productsCount" => self::getProductCount($platform->slug),
        "link" => "/platforms/" . $platform->slug,
      ];
    }
    return $records;
  }

  public static function getProductCount($slug)
  {
    return  Product::whereHas('productAttributes', function ($query)  use ($slug){
      $query->where('attribute_id', Attribute::PLATFORM_ID)
        ->whereIn('value', AttributeValue::where('slug', $slug)
          ->select('id'));
    })->count();
  }



  public static function regenerateData($cache = null): Cache
  {
    $data = [
      "platforms" => self::getPlatforms(),
    ];

    Cache::where("key", "platforms_page")->delete();

    if (!($cache instanceof Cache)) $cache = Cache::create(["key" => "platforms_page", "value" => $data,"version" => config("developer.cacheVersion")]);
    else DB::table("caches")->where("key", "platforms_page")->update(["value" => $data,"version" => config("developer.cacheVersion")]);
    return $cache;
  }

  public static function getPlatformsPage(): array
  {
    if (self::$data != null) return self::$data;
    $platformsPage = Cache::where("key", "platforms_page")->where("version", config("developer.cacheVersion"))->first();
    if (!$platformsPage || config("developer.regeneratePlatforms")) $platformsPage = self::regenerateData($platformsPage);
    else self::$data = $platformsPage->value;
    return $platformsPage->value;
  }
}
