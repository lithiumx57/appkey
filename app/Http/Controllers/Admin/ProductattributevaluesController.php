<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Price;
use App\Models\Product;
use App\Panel\Controllers\XController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductattributevaluesController extends XController
{

  public function index()
  {
    $productId = getXCondition("product-id");
    $product = Product::findOrFail($productId);
    $attributes = Attribute::where("category_id", $product->category_id)->get();
    $records = DB::table("product_attribute_value")->where("product_id", $productId)->get();
    return view("admin.product.attributes", compact("attributes", "product", "productId", "records"));
  }

  public function store(Request $request)
  {

    $attributes = $request->input("attributes");
    $productId = getXCondition("product-id");
    $changePrices = request()->input("change_price");

    DB::table("product_attribute_value")->where("product_id", $productId)->delete();

    $records = [];
    Price::where("product_id", $productId)->delete();


    foreach ($attributes as $key => $value) {
      $changePrice = false;
      if (isset($changePrices[$key])) $changePrice = true;

      foreach ($value as $k => $v) {

        if ($v==0){
          xAlert("انتخاب کردن همه موارد الزامی است","error");
          return  back()->withInput();
        }

        if ($changePrice) {
          $records[$key][] = $v;
        }


        DB::table("product_attribute_value")->insert([
          "attribute_id" => $key,
          "value" => $v,
          "product_id" => $productId,
          "change_price" => $changePrice
        ]);
      }
    }


    $keys = array_keys($records);
    $combinations = combineArraysWithKeys($records, $keys);

    foreach ($combinations as $combination) {
      Price::create([
        "product_id" => $productId,
        "attributes" => $combination,
        "price" => 0,
      ]);
    }

    xAlert("عملیات موفق");


    return back();
  }


  public function savePrice(Request $request)
  {
    $validated = $request->validate([
      'prices' => 'required|array',
      'prices.*' => 'numeric|min:0', // همه قیمت‌ها باید عدد مثبت باشند
    ]);

    // به‌روزرسانی قیمت‌ها
    foreach ($validated['prices'] as $priceId => $priceValue) {
      \App\Models\Price::where('id', $priceId)->update([
        'price' => $priceValue,
      ]);
    }
    xAlert("عملیات موفق");

    return redirect()->back();
  }
}
