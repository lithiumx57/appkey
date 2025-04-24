<?php

namespace App\Livewire\Profile\ProfileAuthentication;

use App\Infrastructure\Auth\Otp\OtpHandler;
use App\Models\OtpCode;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class MobileAuthentication extends Component
{
  public bool $isPhoneOpen = false;
  public string|null $mobile = "";
  public $authenticated = false;
  public bool $isSentCode = false;
  public string $otpCode = "";


  public function mount():void
  {
    $user = auth()->user();
    if ($user->mobile) {
      $this->mobile = $user->mobile;
      $this->authenticated = true;
    } else {
      $this->mobile = "";
      $this->authenticated = false;
    }
  }

  public function sendCode(): void
  {
    try {
      validate()->validateMobile($this->mobile, "شماره موبایل");
      $otpPublisher = resolve(OtpHandler::class);
      $otpPublisher->sendTo($this->mobile);
      toast($this, "کد تایید به شماره موبایل شما ارسال شد", "success");
      $this->isSentCode = true;
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }
  }

  /**
   * @throws Exception
   */
  private function checkCode(): void
  {
    validate()->validateString($this->otpCode, "کد تایید");
    if (!is_numeric($this->otpCode)) {
      throw new Exception("کد تایید وارد شده اشتباه است");
    }

    $result = OtpCode::where("phone", $this->mobile)->where("expire_at", ">", Carbon::now()->toDateTimeString())->where("is_logged_in", false)->first();
    if (!($result instanceof OtpCode)) throw new Exception("کد صحیح نیست یا منقضی شده است");
    if ($result->code != $this->otpCode) throw new Exception("کد صحیح نیست");
    $result->update(["is_logged_in" => 1]);
    auth()->user()->update([
      "mobile" => $this->mobile,
    ]);

  }

  public function confirmCode(): void
  {
    try {
      $this->checkCode();
      $this->otpCode = "";
      $this->mobile = "";
      $this->isSentCode = false;
      $this->isPhoneOpen = false;
      $this->authenticated = true;
      toast($this, "احراز هویت با موفقیت انجام شد", "success");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }
  }

  public function openAutentication(): void
  {
    $this->mobile = "";
    $this->otpCode = "";
    $this->isSentCode = false;
    $this->isPhoneOpen = true;
  }

  public function render()
  {
    return view('livewire.profile.profile-authentication.mobile-authentication');
  }
}
