<?php

namespace App\Observers;

use App\Helpers\CacheHelper\HomePage;
use App\Models\Article;
use App\Repositories\Contracts\BlogRepositoryInterface;

class ArticleObserver
{
  public function created(Article $article): void
  {
    $repo = app(BlogRepositoryInterface::class);
    $repo->generateArticle($article);
    $repo->regenerateHomePage();
    HomePage::regenerateData();
  }

  public function updated(Article $article): void
  {
    $repo = app(BlogRepositoryInterface::class);
    $repo->generateArticle($article);
    $repo->regenerateHomePage();
    HomePage::regenerateData();
  }

  public function deleted(Article $article): void
  {
    $repo = app(BlogRepositoryInterface::class);
    $repo->remove($article);
    $repo->regenerateHomePage();
    HomePage::regenerateData();
  }

  public function restored(Article $article): void
  {
    $repo = app(BlogRepositoryInterface::class);
    $repo->generateArticle($article);
    $repo->regenerateHomePage();
    HomePage::regenerateData();
  }

  public function forceDeleted(Article $article): void
  {
    $repo = app(BlogRepositoryInterface::class);
    $repo->remove($article);
    $repo->regenerateHomePage();
    HomePage::regenerateData();
  }
}
