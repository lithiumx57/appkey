<?php

namespace App\Repositories;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Models\Cache;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Price;
use App\Models\Product;
use App\Repositories\Contracts\CacheRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class CacheRepository implements CacheRepositoryInterface
{

  public function put($key, $data, $version = 1): Cache
  {
    return Cache::create(["key" => $key, "value" => $data, "version" => $version]);
  }

  public function get($key): Cache|null
  {
    return Cache::where($key)->first();
  }

  public function remove($key): void
  {
    Cache::where($key)->delete();
  }
}
