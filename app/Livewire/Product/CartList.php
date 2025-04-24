<?php

namespace App\Livewire\Product;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Product;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Exception;
use Livewire\Component;

class CartList extends Component
{
  public int $productId = -1;
  public array $data = [];


  protected $listeners = [
    'buttons_refresh' => '$refresh'
  ];

  public function mount(ProductRepositoryInterface $productRepository)
  {
    $data = $productRepository->loadFromCache();
    $this->data = $data;
  }


  public function addToCart(): void
  {
    try {
      app(CartRepositoryInterface::class)->add($this->priceId);
      toast($this, "محصول به سبد خرید اضافه شد", 'success');
      $this->dispatch("buttons_refresh");
      $this->dispatch("refresh-header-cart");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }
  }

  public function removeFromCart(): void
  {
    try {
      cart()->remove($this->productId);
      toast($this, "محصول از سبد خرید حذف شد", 'success');
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }
  }

  public function remove($id, $isFull = false): void
  {
    app(CartRepositoryInterface::class)->remove($id,$isFull);
    $this->dispatch("buttons_refresh");
  }

  public function plus($id): void
  {
    try {
      $cartLine = CartLine::find($id);
      if (!$cartLine) return;
      app(CartRepositoryInterface::class)->add($cartLine->price_id);
      $this->dispatch("buttons_refresh");
    }catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }

  }


  public function render()
  {
    $cartRepository = app(CartRepositoryInterface::class);
    $records = $cartRepository->getLinesByProducts($this->productId);
    return view('livewire.product.cart-list', compact("records"));
  }
}
