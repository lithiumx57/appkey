<?php

namespace App\View\Components\Product;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimilarProducts extends Component
{
  public int $productId = -1;
  public ProductRepositoryInterface $productRepository;

  public function __construct($productId, ProductRepositoryInterface $productRepository)
  {
    $this->productId = $productId;
    $this->productRepository = $productRepository;
  }

  public function render(): View|Closure|string
  {

    $product=$this->productRepository->loadFromCache(null);
    $records = $product["similar"];

    return view('components.product.similar-products',compact("records"));
  }
}
