<?php

namespace App\Livewire\Cart;

use App\Repositories\Contracts\CartRepositoryInterface;
use Exception;
use Livewire\Component;

class CartPage extends Component
{

  protected $listeners=[
    'refresh-cart'=>'$refresh',
  ];

  public function plus($lineId): void
  {
    try {
      app(CartRepositoryInterface::class)->add($lineId, "line");
      $this->dispatch("refresh-cart");
      $this->dispatch("refresh-header-cart");
      $this->dispatch("refresh-cart-aside");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }

  }


  public function minus($lineId): void
  {
    try {
      app(CartRepositoryInterface::class)->remove($lineId);
      $this->dispatch("refresh-cart");
      $this->dispatch("refresh-cart-aside");
      $this->dispatch("refresh-header-cart");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }

  }

  public function render()
  {
    $cartRepo = app(CartRepositoryInterface::class);
    $quantity = $cartRepo->getCount();
    $cart = $cartRepo->get();
    $lines = $cartRepo->getLines();
    return view('livewire.cart.cart-page', compact("cart", "quantity", "lines"));
  }

  public function next()
  {
    if (!auth()->check()) {
      return redirect("/auth?back=/cart/complete-information");
    }
    return redirect("/cart/complete-information");
  }

}
