<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\SeoService;

class ProductsController extends Controller
{
  private SeoService $seoService;
  private ProductRepositoryInterface $productRepository;

  public function __construct(SeoService $seoService, ProductRepositoryInterface $productRepository)
  {
    $this->seoService = $seoService;
    $this->productRepository = $productRepository;
  }

  public function single($slug)
  {
    $product = $this->productRepository->loadFromCache($slug);
    $this->seoService->forProduct($product);
    return view('pages.product', compact("product"));
  }
}
