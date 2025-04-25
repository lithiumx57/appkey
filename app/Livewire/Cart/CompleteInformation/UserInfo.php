<?php

namespace App\Livewire\Cart\CompleteInformation;

use App\Infrastructure\Cart\Coupon\Validation\CouponValidator;
use App\Models\Cart;
use App\Models\Gateway;
use App\Repositories\Contracts\CartRepositoryInterface;
use Exception;
use Livewire\Component;

class UserInfo extends Component
{
  public string|null $name = "";
  public string|null $email = "";
  public string|null $phone = "";
  public string|null $coupon = "";
  public string|null $description = "";

  public $gateways = [];
  public $selectedGateway = null;


  public function confirmCoupon(): void
  {
    try {
      CouponValidator::checkCoupon($this->coupon);
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }

  }

  public function mount(): void
  {
    $this->name = auth()->user()->name;
    $this->email = auth()->user()->email;
    $this->phone = auth()->user()->username;
    $this->description = app(CartRepositoryInterface::class)->get()->description;
    $this->gateways = Gateway::where("approved", true)->orderBy("position", "ASC")->get();
    $this->selectedGateway = $this->gateways->get(0);
  }

  public function confirmAndPay(): void
  {
    try {
      validate()->validateString($this->name, "نام", min: 3, max: 50);
      validate()->validateEmail($this->email, "ایمیل", min: 3, max: 50);
      validate()->validateString($this->description, "توضیحات تکمیلی", min: 0, max: 400, required: false);
      auth()->user()->update([
        "name" => $this->name,
        "email" => $this->email,
      ]);
      app(CartRepositoryInterface::class)->updateInfo([
        "description" => $this->description,
        "gateway_id" => $this->selectedGateway->id,
      ]);

      $this->redirect("/cart/complete");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }
  }

  public function gatewayClicked($id): void
  {
    try {
      $this->selectedGateway = Gateway::find($id);
    } catch (Exception) {
      $this->selectedGateway = $this->gateways->get(0);
    }

  }

  public function render()
  {
    $user = auth()->user();
    $cart =   app(CartRepositoryInterface::class)->get();
    return view('livewire.cart.complete-information.user-info', compact("user", "cart"));
  }
}
