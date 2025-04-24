<?php

namespace App\Http\Controllers;

use App\Infrastructure\Cart\CartToOrder\CartToOrder;
use App\Infrastructure\Cart\Validation\CartValidation;
use App\Infrastructure\Payment\PaymentManager;
use App\Models\Cart;
use App\Models\Order;
use Error;
use Exception;
use Throwable;

class CartsController extends Controller
{

  public function index()
  {
    seo()->site("appkey.ir")
      ->title("سبد خرید")
      ->image("image")
      ->type("shop")
      ->url("https://appkey.ir")
      ->locale("fa_IR")
      ->description("فروشگاه appkey");
    return view('pages.cart');
  }

  public function completeInformation()
  {
    $cart = Cart::mine(false);
    if (!$cart || $cart->lines()->count() == 0) return redirect("/cart");
    return view('pages.cart-complete');
  }


  public function complete()
  {
    try {
      CartValidation::validate();
      $order=CartToOrder::init();
      return PaymentManager::init($order);
    } catch (Exception|Error|Throwable) {
      return redirect("/cart/complete-information");
    }

  }


}
