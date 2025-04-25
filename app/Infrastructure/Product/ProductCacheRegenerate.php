<?php

namespace App\Infrastructure\Product;

use App\Models\Attribute;
use App\Models\Cache;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Product;
use App\Panel\Models\Attachment;
use App\Panel\UiHandler\Elements\XMediaChooser;
use App\View\Ui\AttachmentLoader;
use Illuminate\Support\Facades\DB;

class ProductCacheRegenerate
{


  public static function regenerate(Product $product): void
  {
    Cache::where('key', "p_" . $product->id)->delete();
    self::generate($product);
  }

  private static function getComments(Product $product): array
  {
    $comments = Comment::with("approvedChildren")->where("approved", 1)->where("parent", 0)->where("model", Product::class)->where("model_id", $product->id)->latest()->paginate(12);
    return self::castComments($comments);
  }

  private static function castComments($comments): array
  {
    $result = [];
    foreach ($comments as $comment) {
      $result[] = [
        "id" => $comment->id,
        "avatar" => $comment->getAvatar() ?? "",
        "name" => $comment->name,
        "comment" => $comment->comment,
        "children" => self::castComments($comment->approvedChildren),
      ];
    }
    return $result;
  }

  private static function buildTopAttributes($attributes): array
  {
    if (!$attributes) return [];
    return $attributes;
  }

  private static function generateSimilar(Product $product): array
  {
    $attrIds = $product->getAttrIds("game style");

    $attributeId = Attribute::ATTRIBUTES[Attribute::GAME_STYLE_TITLE];
    $ids = DB::table("product_attribute_value")
      ->where("attribute_id", $attributeId)
      ->whereIn("value", $attrIds)
      ->where("product_id", "!=", $product->id)
      ->pluck('product_id')
      ->unique()
      ->take(2)
      ->toArray();

    $products = Product::whereIn("id", $ids)->where("approved", true)->get();
    $records = [];
    foreach ($products as $product) {
      $attachment = Attachment::find($product->image);
      $att = $attachment->getLink(true);

      if (!file_exists($att)) {
        continue;
      }


      $records[] = [
        "link" => $product->getLink(),
        "title_fa" => $product->name_fa,
        "title_en" => $product->name_en,
        "image" => AttachmentLoader::buildHtml($attachment, 300, ["webp", "jpg"], "product", $product->slug),
      ];


    }
    return $records;
  }


  private static function generate(Product $product): Cache|null
  {
    Cache::where('key', "p_" . $product->slug)->delete();

    $attachment = Attachment::find($product->image);
    $image = null;

    if ($attachment) {
      $image = buildAttachmentPaths($attachment, 248, ["webp", "jpg"], "products", $product->slug);
    }

    $smallImage = Attachment::find($product->image);
    $smallImagePath = $smallImage->getLink();

    $data = [
      "id" => $product->id,
      "breadcrumb" => $product->getBreadcrumb(),
      "mainImage" => $image,
      "name_fa" => $product->name_fa,
      "deliveryType" => $product->delivery_type,
      "name_en" => $product->name_en,
      "smallImagePath" => $smallImagePath,
      "attributeValues" => $product->getAttributeValuesData(true),
      "attributes" => $product->getAttributeData(true),
      "topAttrributes" => self::buildTopAttributes($product->_attributes),
      "details" => $product->buildDetails(),
      "prices" => $product->getPricing(),
      "link" => $product->getLink(),
      "description" => $product->description,
      "comments" => self::getComments($product),
      "similar" => self::generateSimilar($product),
      "gallery" => self::gallery($product),
      "image_real_path" => $product->getImage(),
      "seo" => [
        "title" => $product->seo_title,
        "description" => $product->seo_meta,
      ]
    ];

    return Cache::create([
      "key" => "p_" . $product->slug,
      "value" => $data,
      "version" => config("developer.cacheVersion"),
    ]);
  }

  public static function getOrGenerate(Product $product): array
  {
    $cache = Cache::where('key', "p_" . $product->slug)->where("version", config("developer.cacheVersion"))->first();
    if (!$cache || config("developer.regenerateProduct")) $cache = self::generate($product);
    return $cache->value;
  }

  private static function gallery(Product $product): array
  {
    $gallery = Gallery::where("product_id", $product->id)->orderBy("position", "ASC")->get();

    $records = [];

    foreach ($gallery as $row) {
      $attachment = Attachment::find($row->attachment_id);
      if (!$attachment) continue;

      if (XMediaChooser::isVideo($attachment->getLink())) $result = $attachment->getLink();
      else $result = buildAttachmentPaths($attachment, 248, ["webp", "jpg"], "products", "gallery_" . $row->id . "_" . $product->slug);

      $records[] = [
        "type" => $row["type"],
        "file" => $result,
      ];
    }
    return $records;
  }
}
