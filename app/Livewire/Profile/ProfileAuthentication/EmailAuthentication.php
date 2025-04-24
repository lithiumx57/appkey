<?php

namespace App\Livewire\Profile\ProfileAuthentication;

use App\Mail\SendProfileEmailAuthenticationCode;
use App\Models\OtpCode;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class EmailAuthentication extends Component
{
  public bool $isEmailOpened = false;
  public string|null $email = "";
  public $authenticated = false;
  public bool $isSentCode = false;
  public string $code = "";

  protected $listeners = [
    "refresh-email" => '$refresh'
  ];


  public function mount(): void
  {
    $user = auth()->user();
    if ($user->email) {
      $this->email = $user->email;
      $this->authenticated = true;
    } else {
      $this->email = "";
      $this->authenticated = false;
    }
  }

  private function createEmailVerify(): void
  {
    $code = rand(10000, 99999) . "";
    Mail::to($this->email)->send(new SendProfileEmailAuthenticationCode($code));


    OtpCode::create([
      "phone" => $this->email,
      "expire_at" => Carbon::now()->addSeconds(120)->toDateTimeString(),
      "code" => $code,
      "is_logged_in" => false,
      "channel" => null,
      "ip" => request()->ip(),
      "user_id" => auth()->id(),
    ]);
  }

  public function sendCode(): void
  {
    try {
      validate()->validateEmail($this->email, "ایمیل");
      $this->createEmailVerify();
      toast($this, "کد تایید به ایمیل شما ارسال گردید", "success");
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
    validate()->validateString($this->code, "کد تایید");
    if (!is_numeric($this->code)) {
      throw new Exception("کد تایید وارد شده اشتباه است");
    }

    $result = OtpCode::where("phone", $this->email)->where("expire_at", ">", Carbon::now()->toDateTimeString())->where("is_logged_in", false)->first();
    if (!($result instanceof OtpCode)) throw new Exception("کد صحیح نیست یا منقضی شده است");
    if ($result->code != $this->code) throw new Exception("کد صحیح نیست");
    $result->update(["is_logged_in" => 1]);
    auth()->user()->update([
      "email" => $this->email,
    ]);
    $this->dispatch("refresh-email");

  }

  public function confirmCode(): void
  {
    try {
      $this->checkCode();
      $this->code = "";
      $this->email = "";
      $this->isSentCode = false;
      $this->isEmailOpened = false;
      $this->authenticated = true;
      toast($this, "احراز هویت با موفقیت انجام شد", "success");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }
  }

  public function openAutentication(): void
  {
    $this->email = "";
    $this->code = "";
    $this->isSentCode = false;
    $this->isEmailOpened = true;
  }

  public function render()
  {
    return view('livewire.profile.profile-authentication.email-authentication');
  }
}
