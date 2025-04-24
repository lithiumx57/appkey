<?php

namespace App\Repositories\Contracts;

use App\Models\Article;

interface BlogRepositoryInterface
{
  public function regenerateHomePage();

  public function generateArticle(Article $article);

  public function remove(Article $article);

  public function single($slug);

  public function blogHomeData();

}
