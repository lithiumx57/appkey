<?php

namespace App\Livewire\Cart;

use App\Repositories\Contracts\CartRepositoryInterface;
use Livewire\Component;

class HeaderCartlines extends Component
{


  protected $listeners = [
    "refresh-header-cart" => '$refresh',
  ];


  public function render()
  {
    $cart = app(CartRepositoryInterface::class);
    $quantity=$cart->getCount();
    $lines=$cart->getLines();
    $cart = $cart->get();
    return view('livewire.cart.header-cartlines', compact("cart","quantity","lines"));
  }
}
