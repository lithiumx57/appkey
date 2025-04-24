<?php

namespace App\Livewire\Profile;

use App\Infrastructure\Payment\PaymentManager;
use App\Models\Gateway;
use App\Models\Wallet;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileWallet extends Component
{
  public string $price = "";
  use WithPagination;
  protected string $paginationTheme = "bootstrap";


  public function render()
  {
    $this->dispatch("number-format-fields", ["#w-amount", "asasd"]);
    $currency = auth()->user()->wallet;
    $wallets = Wallet::latest()->where("user_id", auth()->user()->id)->paginate(10);
    return view('livewire.profile.profile-wallet', compact("currency", "wallets"));
  }

  public function confirm()
  {
    $price = $this->price;
    $price = str_replace(",", "", $price);
    try {
      if (!is_numeric($price)) throw new Exception("مبلغ باید عددی باشد");
      validate()->validateNumber($price, "مبلغ", min: 5000, max: 50_000_000);
      $wallet = Wallet::create([
        "amount" => $price,
        "user_id" => auth()->user()->id,
        "type" => Wallet::TYPE_CHARGE,
        "gateway_id" => Gateway::ZARINPAL,
        "status" => Gateway::STATUS_PENDING,
        "used" => false,
      ]);
      return PaymentManager::init($wallet);
    } catch (Exception $e) {
      toast($this, $e->getMessage(), "error");
    }
  }
}
