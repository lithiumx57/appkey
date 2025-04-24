<?php

namespace App\Livewire\Blog;

use App\Models\Article;
use App\Panel\Search\XSearchBuilder;
use Carbon\Carbon;
use Livewire\Component;

class BlogHome extends Component
{
  public string $keyword = "";

  public string $type = "new";


  public function sort($type): void
  {
    $this->type = $type;
  }


  public function render()
  {

    $articles = XSearchBuilder::with(Article::class, $this->keyword, ["title","seo_title","_search"])->build()->with("attachment");

    $articles = $articles->where("approved", true)->where(function ($query) {
      $query->where("publish_at", "<", Carbon::now())->orWhere("publish_at", null);
    });

    if ($this->type == "new") $articles = $articles->orderBy("id", "DESC");
    else $articles = $articles->orderBy("id", "ASC");

    $articles = $articles->paginate(12);



    return view('livewire.blog.blog-home', compact("articles"));
  }
}
