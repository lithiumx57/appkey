<?php

namespace App\Infrastructure\Wallet;

use App\Infrastructure\Profile\PaymentLinkCreator;
use App\Models\Wallet;
use App\Models\WalletLog;
use Exception;

class WalletCharge
{
  public static function charge(): array
  {
    $amount = request()->input("amount");
    validate()->validateNumber($amount, 'مبلغ شارژ', min: 2000, max: 100_000_000);
    $user = auth()->user();
    $walletLog = Wallet::create(["status" => Wallet::STATUS_PENDING, "user_id" => $user->id, "amount" => $amount, "used" => false, "token" => "-"]);

    if (!($walletLog instanceof Wallet)) throw new Exception("خطا نامشخض");

    return self::start($walletLog);
  }

  private static function start(Wallet $walletLog): array
  {
    $token = PaymentLinkCreator::generateToken("شارژ کردن کیف پول", $walletLog->amount, env("APP_URL") . "/payment/wallet-callback");

    $walletLog->update([
      "token" => $token,
    ]);

    return [
      "method" => "GET",
      "inputs" => [],
      "action" => 'https://www.zarinpal.com/pg/StartPay/' . $token
    ];
  }

  public static function recharge(): array
  {
    $token = request()->input("token");
    $walletLog = WalletLog::where("token", $token)->first();
    if (!($walletLog instanceof WalletLog)) throw new Exception("تراکنش یافت نشد");
    if ($walletLog->user_id != auth()->user()->id) throw new Exception("تراکنش یافت نشد");
    if ($walletLog->status == WalletLog::STATUS_PAID) throw new Exception("تراکنش قبلا پرداخت شده است");
    $walletLog->update(["used" => false, "status" => WalletLog::STATUS_PENDING, "token" => "-",]);
    return self::start($walletLog);
  }
}
