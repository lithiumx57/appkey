<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface SocialRepositoryInterface
{
  public function cacheData():Collection;

  public function loadFromCache(): Collection;

}
