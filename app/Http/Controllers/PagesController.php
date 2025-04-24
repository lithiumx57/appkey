<?php

namespace App\Http\Controllers;

use App\Panel\Models\Head;
use View;

class PagesController extends Controller
{


  public function search()
  {
    $q = request()->input("q");
    $noFooter = true;
    if (!$q) return view('pages.search-index',compact("noFooter"));
    return view('pages.search', compact('q'));
  }

  public function login()
  {
    View::share([
      "hasFooter" => false
    ]);
    return view('pages.login');
  }


  public function contactUs()
  {
    return view('pages.contact-us');
  }

  public function aboutUs()
  {
    return view('pages.about-us');
  }

  public function spacialOffers()
  {
    return view('pages.spacial-offers');
  }


}
