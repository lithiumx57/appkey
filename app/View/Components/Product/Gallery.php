<?php

namespace App\View\Components\Product;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Gallery extends Component
{

  public $productId;

  public function __construct($productId)
  {
    $this->productId = $productId;
  }

  public function render(): View|Closure|string
  {
    $records=app(ProductRepositoryInterface::class)->getGallery();
    return view('components.product.gallery', compact("records"));
  }
}
