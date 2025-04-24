<?php

namespace App\Http\Controllers;

use App\Helpers\CacheHelper\HomePage;
use App\Panel\Models\Head;

class HomeController extends Controller
{
  public function index()
  {
    $data = HomePage::getHomeData();

    seo()->site("appkey.ir")
      ->title($data["seo"]["title"])
      ->image("image")
      ->type("shop")
      ->url("https://appkey.ir")
      ->locale("fa_IR")
      ->description($data["seo"]["description"]);
    return view('pages.home');
  }
}
