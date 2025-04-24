<?php

use App\Http\Controllers\Admin\ProductattributevaluesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PlatformsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Panel\UiHandler\Elements\XMediaChooser;
use Illuminate\Support\Facades\Route;



Route::group(["prefix" => "/", "middleware" => ["frontend"]], function () {
  Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::get('/products/{slug}', [ProductsController::class, 'single'])->name('product');

  Route::any("/cart/{method?}", [CartsController::class, 'route']);
  Route::any("/profile/{method?}/{p1?}/{p2?}/{p3?}", [ProfileController::class, 'route']);

  Route::get('/auth', [PagesController::class, 'login'])->name('login');
  Route::get('/contact-us', [PagesController::class, 'contactUs']);
  Route::get('/search', [PagesController::class, 'search'])->name('search');
  Route::get('/blog/{slug}', [BlogController::class, 'single']);
  Route::get('/blog/{slug?}', [BlogController::class, 'route']);
  Route::get('/platforms', [PlatformsController::class, 'route']);
  Route::get('/platforms/{platform}', [PlatformsController::class, 'platform']);
  Route::get('/special-offers', [PagesController::class, 'spacialOffers']);

  Route::get('/admin/productattributevalues', [ProductattributevaluesController::class, 'index']);
  Route::post('/admin/productattributevalues/store', [ProductattributevaluesController::class, 'store']);
  Route::post('/admin/productattributevalues/savePrice', [ProductattributevaluesController::class, 'savePrice']);


  Route::get("/test", function () {
    return view("welcome");
  });


});




Route::get("Asdasdasdas",function (){
    dd(\App\Panel\Models\Attachment::latest()->first()->getLink());

  $code="32135465";
  return view("pages.emails.email-authentication",compact("code"));
});
