<?php

namespace App\Providers;

use App\Infrastructure\Auth\Otp\Factories\KavehnegarDriverFactory;
use App\Infrastructure\Auth\Otp\OtpPublisher;
use App\Infrastructure\Payment\Factories\ZarinpalDriverFactory;
use App\Infrastructure\Payment\PaymentHandler;
use App\Models\Article;
use App\Models\Product;
use App\Observers\ArticleObserver;
use App\Observers\ProductObserver;
use App\Repositories\BlogRepository;
use App\Repositories\CacheRepository;
use App\Repositories\CartRepository;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\CacheRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(OtpPublisher::class, KavehnegarDriverFactory::class);
    $this->app->bind(PaymentHandler::class, ZarinpalDriverFactory::class);
    $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    $this->app->bind(CacheRepositoryInterface::class, CacheRepository::class);
    $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);


  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Paginator::useBootstrap();
    $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
    $this->app->singleton(CartRepositoryInterface::class, CartRepository::class);
    Product::observe(ProductObserver::class);
    Article::observe(ArticleObserver::class);

  }
}
