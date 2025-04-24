<?php

namespace App\Livewire;

use App\Infrastructure\Auth\Otp\Otp;
use App\Infrastructure\Auth\Otp\OtpHandler;
use App\Models\Cart;
use Exception;
use Livewire\Component;

class PopupLogin extends Component
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

  public bool $active = false;


  public $event = null;
  public $data = [];


  protected $listeners = [
    "timedout",
    "show-popup-login" => "showPopupLogin",
  ];


  public function showPopupLogin($data): void
  {
    $this->event = @$data["event"];
    $this->data = @$data["data"];
    $this->active = true;
  }


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

  public function dismiss(): void
  {
    $this->event = null;
    $this->data = [];
    $this->active = false;
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
      $this->mode = "code";

      toast($this, "کد تایید با موفقیت ارسال شد", "success");
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
      if ($this->event) {
        $this->dispatch($this->event, ["data" => $this->data]);
        $this->dismiss();
      }
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

  public function render()
  {
    $this->formatTime($this->time);
    return view('livewire.popup-login');
  }
}
