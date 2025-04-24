<?php

namespace App\Infrastructure\Cart\CartToOrder;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderline;
use Illuminate\Support\Str;

class CartToOrder
{

  public static function init(): Order
  {

    $cart = Cart::mine(false);
    $user = auth()->user();
    if (!$user) abort(403);

    $coupon = $cart->coupon;
    $couponData = [];
    if ($coupon) {
      $couponData["has"] = true;
      $couponData["code"] = $coupon->code;
    }else{
      $couponData["has"] = false;
      $couponData["code"] = null;
    }

    $order = Order::create([
      "user_id" => $user->id,
      "name" => $user->id,
      "price" => cart()->getPrice(),
      "status" => Order::STATUS_PENDING,
      "gateway_id" => $cart->gateway_id,
      "channel" => "-",
      "coupon_id" => $cart->coupon_id,
      "latest_message" => $cart->description ? Str::substr($cart->description, 0, 20) : null,
      "extra_data" => [
        "coupon" => $couponData,
      ],
      "mobile" => $user->username,
    ]);

//    $order = Order::latest()->first();

    foreach ($cart->lines as $line) {
      $productData = $line->product->getAttributes();
      unset($productData['description']);
      unset($productData['data']);
      unset($productData['_tags']);
      unset($productData['_attributes']);
      unset($productData['seo_title']);
      unset($productData['seo_meta']);
      unset($productData['score']);
      unset($productData['created_at']);
      unset($productData['updated_at']);
      unset($productData['category_id']);
      unset($productData['deleted_at']);
      unset($productData['views_count']);
      unset($productData['approved']);
      unset($productData['can_add_multiple']);

      $priceData = $line->price->getAttributes();
      unset($priceData['created_at']);
      unset($priceData['updated_at']);

      $attrs = $line->price->getAttribute("attributes");
      $arrtsRecords = [];

      foreach ($attrs as $key => $attr) {
        $attribute = Attribute::find($key);
        $av = AttributeValue::find($attr);
        $arrtsRecords[$attribute->label] = $av->title_fa;
      }
      $priceData["extractedAttributes"] = $arrtsRecords;


      Orderline::create([
        "order_id" => $order->id,
        "status" => OrderLine::STATUS_PENDING,
        "quantity" => $line->qty,
        "price" => $line->price->price,
        "price_data" => $priceData,
        "product_data" => $productData,
        "name" => $line->product->name_fa,
        "mode" => $line->product->delivery_type,
      ]);
    }

    return $order;
  }
}
