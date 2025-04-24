<?php

namespace App\View\Components\Home;

use App\Helpers\CacheHelper\HomePage;
use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Blog extends Component
{
  public $articles;

  public function __construct()
  {
    $data = HomePage::getHomeData();
    $this->articles = $data["articles"];
  }

  public function render(): View|Closure|string
  {
    return view('components.home.blog');
  }
}
