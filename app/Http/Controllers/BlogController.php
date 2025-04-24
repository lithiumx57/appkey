<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;

class BlogController extends Controller
{
  public function index()
  {
    $breadcrumbs = [
      ["link" => "/blog", "title" => "وبلاگ"],
    ];

    return view('pages.blog-home', compact("breadcrumbs"));
  }

  public function single($slug)
  {
    $article = Article::where('slug', $slug)->firstOrFail();

    $breadcrumbs = [
      ["link" => "/blog", "title" => "وبلاگ"],
      ["link" => "", "title" => $article->title]
    ];
    return view('pages.blog-single', compact("breadcrumbs", "article"));
  }

}
