<?php

namespace App\Infrastructure\Product;

use App\Models\Product;

trait ProductDataTrait
{
  public static function saveSystemRequirement(){
    $data = request()->all();
    $productId = $data["productId"];
    unset($data['x-conditions']);
    unset($data['_token']);
    unset($data['productId']);
    unset($data['type']);


    $product = Product::find($productId);
    self::attachData($product, "systemRequirement", $data);
    xAlert("عملیات با موفقیت انجام شد");
    return back();
  }



  public static function attachData(Product $product, $key, $value)
  {
    $data = $product->data;
    if (!is_array($data)) $data = [];
    $data[$key] = $value;
    $product->update([
      "data" => $data
    ]);
  }


  public function systemRequirement(): array
  {
    $productId = getXCondition("product-id");
    $product = Product::find($productId);

    $data = $product->data;
    if (!is_array($data)) $data = [];
    if (!is_array($data["systemRequirement"])) $data["systemRequirement"] = [];

    $data = $data["systemRequirement"];

    return [
      xField()->hidden("type")->default("systemRequirement"),
      xField()->hidden("productId")->default($productId),

      xField()->simpleText("حد اقل سیستم مورد نیاز"),
      xField()->hr(),
      xField()->string("os_m")->label("سیستم عامل")->default(@$data["os_m"]),
      xField()->string("cpu_m")->label("پردازنده")->default(@$data["cpu_m"]),
      xField()->string("RAM_m")->label("رم")->default(@$data["RAM_m"]),
      xField()->string("graphicCard_m")->label("کارت گرافیک")->default(@$data["graphicCard_m"]),
      xField()->string("hardDrive_m")->label("حافظه")->default(@$data["hardDrive_m"]),
      xField()->hr(),
      xField()->simpleText("سیستم پیشنهادی"),
      xField()->hr(),


      xField()->string("os")->label("سیستم عامل")->default(@$data["os"]),
      xField()->string("cpu")->label("پردازنده")->default(@$data["cpu"]),
      xField()->string("RAM")->label("رم")->default(@$data["RAM"]),
      xField()->string("graphicCard")->label("کارت گرافیک")->default(@$data["graphicCard"]),
      xField()->string("hardDrive")->label("حافظه")->default(@$data["hardDrive"]),

    ];
  }

}
