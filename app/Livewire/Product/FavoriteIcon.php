<?php

namespace App\Livewire\Product;

use App\Models\Favorite;
use App\Models\Product;
use Exception;
use Livewire\Component;

class FavoriteIcon extends Component
{
  public $id;
  public $model;

  protected $listeners = [
    "refreshFav" => '$refresh',
    "favorite-login-done" => "favLoginDone"
  ];

  public function favLoginDone($data): void
  {

    try {
      $added = Favorite::switch($data["data"]["model"], $data["data"]["modelId"]);
      if ($added) {
        toast($this, "محصول به علاقه مندی ها اضافه شد", 'success');
      } else {
        toast($this, "محصول از علاقه مندی ها حذف شد", 'success');
      }
      $this->dispatch("refreshFav");
    } catch (Exception $e) {
      toast($this, $e->getMessage(), 'error');
    }
  }


  public function render()
  {
    if (auth()->check()) {
      $result = Favorite::where([
        'user_id' => auth()->user()->id,
        "model" => Product::class,
        "model_id" => $this->id,
      ])->first();
    } else {
      $result = null;
    }

    return view('livewire.product.favorite-icon', compact('result'));
  }

  public function showLoginPopup(): void
  {
    if (auth()->check()) {
      $this->favLoginDone([
        "data" => [
          "model" => $this->model,
          "modelId" => $this->id,
        ]
      ]);
      return;
    }
    $this->dispatch("show-popup-login", [
      "event" => "favorite-login-done",
      "data" => [
        "model" => $this->model,
        "modelId" => $this->id,
      ]
    ]);
  }

  public function removeFromFavorites(): void
  {
    try {
      Favorite::switch("product", $this->id);
      toast($this, "محصول به علاقه مندی ها اضافه شد", 'success');
//      $this->dispatch("refreshFav");

    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }
  }

  public function addToFavorites(): void
  {
    try {
      if (auth()->check()) {
        Favorite::switch("product", $this->id);
        toast($this, "محصول از علاقه مندی ها حذف شد", 'success');
      }
//      $this->dispatch("refreshFav");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), 'error');
    }

  }


}
