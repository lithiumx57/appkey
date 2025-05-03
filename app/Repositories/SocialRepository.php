<?php

namespace App\Repositories;

use App\Models\Social;
use App\Repositories\Contracts\SocialRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SocialRepository implements SocialRepositoryInterface
{

  public function cacheData(): Collection
  {
    $socials = Social::orderBy("position", "ASC")->where("approved", true)->get();
    Cache::put("socials", $socials, now()->addMonths(12));
    return $socials;
  }

  public function loadFromCache(): Collection
  {
    $cache = Cache::get("socials");
    if (!$cache) {
      $cache = $this->cacheData();
    }
    return $cache;
  }
}
