<?php

namespace App\Infrastructure\Auth\Otp;

use App\Infrastructure\Auth\Strategies\Jwt;
use App\Infrastructure\Auth\UserCreator;
use App\Models\OtpCode;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class OtpHandler
{
  private OtpPublisher $publisher;
  public const TIME = 90;

  public function __construct(OtpPublisher $otpPublisher)
  {
    $this->publisher = $otpPublisher;
  }


  /**
   * @throws Exception
   */
  public function sendTo($mobile): array
  {
    if ($mobile) {
      $mobile = convertToEnglishDigit($mobile);
    }

    $result = self::getVerify($mobile);
    if ($result) return $this->parseData($result, "کد تایید قبلا برای شما ارسال شده است", "sentBefore");
    $verify = $this->createVerify($mobile);
    $otp = new Otp($mobile, $verify->code);
    $this->publisher->publish($otp);
    return $this->parseData($verify, "کد تایید به شماره موبایل شما ارسال شد", "sent");
  }


  private function parseData(OtpCode $OtpCode, $message, $status): array
  {
    return [
      "status" => $status,
      "time" => Carbon::parse($OtpCode->expire_at)->timestamp - Carbon::now()->timestamp,
      "message" => $message,
    ];
  }

  private static function getUser($mobile): User
  {
    return UserCreator::createOrGet($mobile);
  }

  private function createVerify($mobile): OtpCode
  {
    $channel = request()->input("channel");
    $user = $this->getUser($mobile);
    return OtpCode::create([
      "phone" => $mobile,
      "expire_at" => Carbon::now()->addSeconds(self::TIME)->toDateTimeString(),
      "code" => $this->generateCode(),
      "is_logged_in" => false,
      "channel" => $channel,
      "ip" => request()->ip(),
      "user_id" => $user->id,
    ]);
  }

  private function generateCode(): string
  {
    return rand(10000, 99999) . "";
  }

  private static function getVerify($mobile): OtpCode|null
  {
    $result = OtpCode::where("phone", $mobile)->where("expire_at", ">", Carbon::now()->toDateTimeString())->where("is_logged_in", false)->first();
    if ($result instanceof OtpCode) return $result;
    return null;
  }

  /**
   * @throws Exception
   */
  public static function verify(Otp $otp): void
  {
    $result = self::getVerify($otp->getMobile());

    if (!($result instanceof OtpCode)) {
      throw new Exception("کد صحیح نیست یا منقضی شده است");
    }

    if ($result->code != $otp->getCode()) {
      throw new Exception("کد صحیح نیست");
    }

    $result->update([
      "is_logged_in" => 1
    ]);

    $user = self::getUser($otp->getMobile());
    auth()->login($user, true);
  }


}
