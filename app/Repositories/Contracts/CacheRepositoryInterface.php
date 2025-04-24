<?php

namespace App\Repositories\Contracts;

use App\Models\Cache;

interface CacheRepositoryInterface
{
  public function put($key, $data,$version=1):Cache;

  public function get($key):Cache|null;

  public function remove($key):void;

}
