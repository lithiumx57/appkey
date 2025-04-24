<?php

namespace App\Livewire\Profile\ProfileAuthentication;

use Exception;
use Livewire\Component;

class CreditAuthentication extends Component
{
  public bool $isOpened = false;
  public bool $authenticated = false;
  public bool $confirmed = false;
  public string|null $credit = "";


  public function mount(): void
  {
    $user = auth()->user();
    if ($user->credit) {
      $this->credit = $user->credit;
      $this->confirmed = $user->credit_confirmed;
      $this->authenticated = true;
    }
  }

  public function openAutentication()
  {
    $this->isOpened = true;
  }

  public function confirm(): void
  {
    try {
      validate()->validateString($this->credit, "شماره شبا", min: 16, max: 40);
      auth()->user()->update([
        "credit" => $this->credit,
        "credit_confirmed" => false,
      ]);

      $this->authenticated = true;
      $this->confirmed = false;
      $this->isOpened = false;
      toast($this, "احراز هویت با موفقیت انجام شد", "success");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }
  }


  public function render()
  {
    return view('livewire.profile.profile-authentication.credit-authentication');
  }
}
