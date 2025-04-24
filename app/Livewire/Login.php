<?php

namespace App\Livewire;

use App\Infrastructure\Auth\Otp\Otp;
use App\Infrastructure\Auth\Otp\OtpHandler;
use App\Models\Cart;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Login extends Component
{
  public string $phone = "";
  public string $code = "";
  public string $errorText = "لطفا این قسمت را خالی نگذارید";
  public string $mode = "index";
  public string $back = "/";
  public int $time = OtpHandler::TIME;
  public bool $timedout = false;
  public string $timeText = "";
  public bool $isShippingMode = false;

  protected $listeners = [
    "timedout"
  ];


  private function formatTime($time): void
  {
    $minutes = floor($time / 60);
    $seconds = $time % 60;
    $this->timeText = sprintf("%02d:%02d", $minutes, $seconds);
  }

  public function timedout(): void
  {
    $this->timedout = true;
  }

  public function mount(): void
  {
    $back = request()->input("back");
    if (!$back) $back = "/";
    $this->back = $back;
    if (auth()->check()) {
      $this->redirect($this->back);
    }
    if ($back == "/cart/complete-information") {
      $this->isShippingMode = true;
    }
  }


  public function render(): Application|Factory|View|\Illuminate\View\View
  {
    $this->formatTime($this->time);
    return view('livewire.login');
  }


  /**
   * @throws Exception
   */
  private function initSendResult($data): void
  {
    if ($data["status"] == "sent") {
      $this->time = $data["time"];
      $this->timedout = false;
      return;
    }
    if ($data["status"] == "sentBefore") {
      $this->time = $data["time"];
      $this->timedout = false;
      throw new Exception($data["message"]);
    }
  }


  public function sendCode(): void
  {
    try {
      validate()->validateMobile($this->phone, "شماره موبایل");
      $result = resolve(OtpHandler::class);
      $result = $result->sendTo($this->phone);
      $this->initSendResult($result);

      $this->errorText = "";
      $this->code = "";
      $this->dispatch("refresh-timing", ["time" => $this->time]);
      toast($this, "کد تایید با موفقیت ارسال شد", "success");
      $this->mode = "code";

    } catch (Exception $exception) {
      $this->dispatch("refresh-timing", ["time" => $this->time]);
      $this->errorText = $exception->getMessage();
      toast($this, $exception->getMessage(), "error");
    }
  }

  public function confirmCode(): void
  {
    try {
      $code = $this->code;
      $mobile = $this->phone;
      $sessionId = session()->id();
      validate()->validateString($mobile, "شماره موبایل", equals: 11);
      validate()->validateString($code, "کد تایید", equals: 5);
      OtpHandler::verify(new Otp($mobile, $code));
      Cart::merge($sessionId);
      toast($this, "ورود با موفقیت انجام شد", "success");
      $this->redirect($this->back);
    } catch (Exception $exception) {
      $this->errorText = $exception->getMessage();
      toast($this, $exception->getMessage(), "error");
    }
  }

  public function backToIndex(): void
  {
    $this->mode = "index";
    $this->code = "";
    $this->phone = "";
  }


}
