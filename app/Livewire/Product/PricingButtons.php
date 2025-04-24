<?php

namespace App\Livewire\Product;

use App\Infrastructure\Product\ProductCacheRegenerate;
use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Exception;
use Livewire\Component;

class PricingButtons extends Component
{
  public int $productId = -1;
  public array $data = [];
  public string $priceText = "لطفا گزینه های مورد نظر خود را انتخاب نمایید.";
  public array $selection = [];
  public bool $isSelected = false;
  public int $priceId = -1;



  protected $listeners = [
//    'buttons_refresh' => '$refresh'
  ];




  public function mount(ProductRepositoryInterface $productRepository)
  {
    $data = $productRepository->loadFromCache();

    $selectedPrice = PHP_INT_MAX;
    $selectedRow = null;

    foreach ($data["prices"] as $row) {
      if ($row["price"] == 0) continue;
      if ($row["price"] < $selectedPrice) {
        $selectedPrice = $row["price"];
        $selectedRow = $row;
      }
    }

    if ($selectedRow) $this->select($selectedRow);
    else $this->select();
    $this->data = $data;
  }


  private function select($price = null): void
  {
    if ($price) {
      $this->selection = $price["attributes"];
      $this->isSelected = true;
      $this->priceId = $price["id"];
      $this->priceText = number_format($price["price"]);
    } else {
      $this->isSelected = false;
      $this->priceText = "ناموجود";
      $this->priceId = -1;
    }

  }

  public function render()
  {
    return view('livewire.product.pricing-buttons');
  }

  public function buttonClicked($attributeValueId, $attributeId): void
  {
    $this->selection[$attributeId] = $attributeValueId;
    $this->isSelected = false;
    foreach ($this->data["prices"] as $price)
      if ($price["attributes"] == $this->selection) {
        $this->select($price["price"] > 0 ? $price : null);
      }
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

//
//  public function remove($id, $isFull = false): void
//  {
//    $cart = Cart::mine(false);
//    if (!$cart) return;
//
//    $line = $cart->lines()->where("product_id", $this->productId)->where('id', $id)->first();
//    if (!$line) return;
//    if ($isFull) {
//
//      $line->delete();
//      $this->dispatch("buttons_refresh");
//      return;
//    }
//
//    if ($line->qty > 1) $line->update(["qty" => $line->qty - 1]);
//    else $line->delete();
//    $this->dispatch("buttons_refresh");
//  }

//  public function plus($id): void
//  {
//    $cart = Cart::mine(false);
//    if (!$cart) return;
//    $line = $cart->lines()->where("product_id", $this->productId)->where('id', $id)->first();
//    if (!$line) return;
//    $line->update(["qty" => $line->qty + 1]);
//    $this->dispatch("buttons_refresh");
//  }


}
