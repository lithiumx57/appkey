<?php

namespace App\Repositories;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Models\Cache;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
  private array|null $cachedData = null;

  public function findBySlug($slug): Product
  {
    return Product::where('slug', $slug)->firstOrFail();
  }

  public function loadFromCache($slug = null): array
  {
    if ($this->cachedData != null) return $this->cachedData;
    $cache = Cache::where("key", "p_" . $slug)->where("version", config("developer.cacheVersion"))->first();
    if (config('developer.regenerateProduct')) $cache = $this->generateCache($slug);
    if (!$cache) $cache = $this->generateCache($slug);
    return $this->cachedData = $cache instanceof Cache ? $cache->value : $cache;
  }

  private function generateCache($slug): array
  {
    $product = $this->findBySlug($slug);
    return ProductCacheRegenerate::getOrGenerate($product);
  }
}
