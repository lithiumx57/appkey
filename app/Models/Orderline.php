<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use App\Panel\Models\Attachment;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Throwable;

/**
 * @property $id
 * @property $order_id
 * @property Order $order
 * @property $name
 * @property $price
 * @property $status
 * @property $mode
 * @property $product_data
 * @property $price_data
 * @property $quantity
 * @property $latest_message
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Orderline extends Model
{
  use SoftDeletes, XModelHelper;

  protected $guarded = ["id"];
  public const STATUS_PENDING = 0;
  public const STATUS_WORKING = 1;
  public const STATUS_DELIVERED = 2;
  protected $table="order_lines";

  protected $casts = [
    "product_data" => "array",
    "price_data" => "array",
  ];

  public function getImage():string|null
  {
    try {
      return Attachment::find($this->product_data["image"])->getLink();
    }catch (Exception|Error|Throwable){
      return null;
    }

  }

}
