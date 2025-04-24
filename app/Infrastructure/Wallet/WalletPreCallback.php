<?php

namespace App\Infrastructure\Wallet;

use App\Infrastructure\Profile\PaymentLinkCreator;
use App\Models\Wallet;
use App\Models\WalletLog;
use Exception;
use Illuminate\Http\RedirectResponse;

class WalletPreCallback
{


  public static function init()
  {

    $token = request()->input("Authority");
    try {
      if (!$token) throw new Exception("تراکنش یافت نشد");
      $result = Wallet::where("token", $token)->first();
      if (!($result instanceof Wallet)) throw new Exception("تراکتش یافت نشد");

      if ($result->used) $isValid = $result->isSuccess();
      else $isValid = PaymentLinkCreator::validate($result->amount, $result->token);


      if ($isValid) {
        if (!$result->used) $result->user->walletCharge($result);
        else $result->update(["used" => true, "status" => WalletLog::STATUS_PENDING]);
      }
      $result->update(["used" => true]);
    } catch (Exception) {
      $token = "-1";
    }
    return self::response($token);
  }

  public static function response($token): RedirectResponse
  {
    return redirect(env("FRONTEND_URL") . "/payment/wallet-callback?token=" . $token);
  }

}

