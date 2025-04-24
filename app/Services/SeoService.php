<?php

namespace App\Services;

use App\Models\Product;

class SeoService
{
  public function forProduct(array $product): void
  {
    seo()->site($product["link"])
      ->title($product["seo"]["title"])
      ->image($product["image_real_path"])
      ->type("shop")
      ->url($product["link"])
      ->locale("fa_IR")
      ->description($product["seo"]["title"]);
  }
}
