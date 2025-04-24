<?php

namespace App\Repositories;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Models\Article;
use App\Models\Cache;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Price;
use App\Models\Product;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\CacheRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;

class BlogRepository implements BlogRepositoryInterface
{


  public function generateArticle(Article $article): void
  {
    $user = $article->user;
    $category = $article->category;

    $data = [
      "thumbnail" => [
        "500" => buildAttachmentPaths($article->attachment, "500", ["webp", "jpg"], "blog", $article->slug),
        "1000" => buildAttachmentPaths($article->attachment, "1000", ["webp", "jpg"], "blog", $article->slug),
      ],
      "user" => [
        "name" => $user->getName(),
        "avatar" => $user->getAvatar(),
      ],
      "category" => [
        "name" => $category->label,
      ]
    ];

    Article::withoutEvents(function () use ($article, $data) {
      $article->update([
        "cached_data" => $data,
      ]);
    });
  }

  public function single($slug)
  {

  }

  public function blogHomeData()
  {
    $cache = Cache::where("key", "blog_home")->first();
    if (!$cache) {
      $this->regenerateHomePage();
      $cache = Cache::where("key", "blog_home")->first();
    }
    return $cache;
  }

  public function regenerateHomePage()
  {
//    dd("asd");
  }

  public function remove(Article $article)
  {
    // TODO: Implement remove() method.
  }
}
