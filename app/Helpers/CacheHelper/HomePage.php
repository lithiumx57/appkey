<?php

namespace App\Helpers\CacheHelper;

use App\Models\Article;
use App\Models\AttributeValue;
use App\Models\Cache;
use App\Models\Product;
use App\Models\Slide;
use App\Panel\Models\Attachment;
use App\Panel\Models\Head;
use Illuminate\Support\Facades\DB;

class HomePage
{
  private static array|null $data = null;

  private static function getSlides(): array
  {
    $slides = Slide::where("approved", true)->orderBy("position", "ASC")->get();
    $records = [];
    foreach ($slides as $slide) {
      $attachment = Attachment::find($slide->images);
      if (!$attachment) continue;
      $records[] = [
        "image" => buildAttachmentPaths($attachment, 1300, ["webp", "jpg"], "home", "slide-" . $slide->id),
      ];
    }
    return $records;
  }


  private static function getArticles(): array
  {
    $articles = Article::where("approved", true)->get();
    $records = [];
    foreach ($articles as $article) {
      $records[] = [
        "image" => buildAttachmentPaths(Attachment::find($article->image), 200, ["webp", "jpg"], "articles", $article->slug),
        "title" => $article->title,
        "link" => $article->getLink(),
      ];
    }
    return $records;
  }


  private static function getPlatforms(): array
  {
    $platforms = AttributeValue::getPlatforms();
    $records = [];
    foreach ($platforms as $platform) {
      $records[] = [
        "image" => buildAttachmentPaths(Attachment::find($platform->image), 180, ["webp", "jpg"], "platforms", $platform->slug),
        "title" => $platform->title_fa,
        "link" => "/platforms/" . $platform->slug,
      ];
    }
    return $records;
  }


  private static function getSuggestions(): array
  {
    $records = [];
    $products = Product::latest()->where("approved", true)->limit(10)->get();

    foreach ($products as $product) {
      $attachment = Attachment::find($product->image);
      $image = null;
      if ($attachment) {
        $image = buildAttachmentPaths($attachment, 180, ["webp", "jpg"], "products", $product->slug);
      }


      $records[] = [
        "link" => $product->getLink(),
        "image" => $image,
//        "categories" => $product->getDefaultImage(),
        "name" => $product->name_fa,
      ];
    }

    return $records;
  }

  private static function getSeoData(): array
  {
    $title = Head::getRow("home_title_fa")->value;
    $description = Head::getRow("home_description_fa")->value;
    return ["title" => $title, "description" => $description];
  }

  public static function regenerateData($cache = null):array
  {

    $data = [
      "slides" => self::getSlides(),
      "suggestions" => self::getSuggestions(),
      "articles" => self::getArticles(),
      "platforms" => self::getPlatforms(),
      "seo" => self::getSeoData(),
//      "categories" => $slide->getDefaultImage(),
    ];

    Cache::where("key", "home_page")->delete();

    if (!($cache instanceof Cache)) $cache = Cache::create(["key" => "home_page", "value" => $data, "version" => config("developer.cacheVersion")]);
    else DB::table("caches")->where("key", "home_page")->update(["value" => $data, "version" => config("developer.cacheVersion")]);
    self::$data = $data;
    return $data;
  }

  public static function getHomeData(): array
  {
    if (self::$data != null) return self::$data;
    $homePage = Cache::where("key", "home_page")->where("version", config("developer.cacheVersion"))->first();
    if (!$homePage || config("developer.regenerateHome")) self::$data = self::regenerateData($homePage);
    else self::$data = $homePage->value;
    return self::$data;
  }
}
