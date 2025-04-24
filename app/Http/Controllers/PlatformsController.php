<?php

namespace App\Http\Controllers;

use App\Helpers\CacheHelper\PlatformsPage;

class PlatformsController extends Controller
{

  public function index()
  {
    $data = PlatformsPage::getPlatformsPage();
    $breadcrumbs = [
      [
        "title" => "پلتفورم ها",
        "link" => "/platforms",
      ]
    ];
    return view('pages.platforms', compact("data", "breadcrumbs"));
  }

  public function platform($slug)
  {
    return view('pages.platform', compact("slug"));
  }

}
