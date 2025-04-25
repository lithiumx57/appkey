<?php

namespace App\Http\Controllers;

use App\Helpers\CacheHelper\HomePage;
use App\Panel\Models\Head;
use App\Repositories\Contracts\CartRepositoryInterface;

class HomeController extends Controller
{
  public function index()
  {
    $data = HomePage::getHomeData();


    $cart = app(CartRepositoryInterface::class);
    $quantity=$cart->getCount();
    $lines=$cart->getLines();
    $cart = $cart->get();


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
