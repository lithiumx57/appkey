<?php

namespace App\View\Components\Product;

use App\Infrastructure\Product\ProductCacheRegenerate;
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
    $product = ProductCacheRegenerate::getOrGenerate(6);
    $records = $product["gallery"];
    return view('components.product.gallery', compact("records"));
  }
}
