<?php

namespace App\Observers;

use App\Models\Product;
use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Repositories\Contracts\CacheRepositoryInterface;

class ProductObserver
{
  public function created(Product $product): void
  {
    ProductCacheRegenerate::regenerate($product);
  }

  public function updated(Product $product): void
  {
    ProductCacheRegenerate::regenerate($product);
  }

  public function deleted(Product $product): void
  {
    $cacheRepository = resolve(CacheRepositoryInterface::class);
    $cacheRepository->remove("p_" . $product->slug);
  }

  public function restored(Product $product): void
  {
    ProductCacheRegenerate::regenerate($product);
  }

  public function forceDeleted(Product $product): void
  {
    $cacheRepository = resolve(CacheRepositoryInterface::class);
    $cacheRepository->remove("p_" . $product->slug);
  }
}
