<?php

namespace App\Models;

use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use ReflectionClass;


/**
 * @property $id
 * @property $model
 * @property $model_id
 * @property $user_id
 * @property User $user
 * @property $mode
 * @property $text
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ModelLog extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];

  public static function getLatestMessage($model, $modelId): string
  {
    $olq = static::where("model", $model)->where("model_id", $modelId)->latest()->first();

    if ($olq) {
      return Str::substr($olq->message, 0, 20);
    }
    return "بدون پیام";
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }


  public static function getMessages($model, $modelId, $mode = 0)
  {
    return static::where("model", $model)->where("model_id", $modelId)->where("mode", $mode)->latest()->get();
  }


  public static function createLog($model, $modelId, $message, $mode = 0)
  {
    if (!(user()->me() instanceof User)) return null;


    $modelLog = static::create([
      "model" => $model,
      "model_id" => $modelId,
      "text" => $message,
      "user_id" => user()->getId(),
      "mode" => $mode
    ]);
    $model::find($modelId)->messageCreated($modelLog);
    return $modelLog;
  }


  public function t(): BelongsTo
  {
    return $this->belongsTo($this->model, "model_id");
  }

  public static function hasMessageLogMethod($model): bool
  {
    $reflectionClass = new ReflectionClass($model);
    if ($reflectionClass->hasMethod("getMessageType")) {
      return true;
    }
    return false;
  }

  public static function getMessageType($message)
  {
    return resolve($message->model)->getMessageType($message);
  }


}
