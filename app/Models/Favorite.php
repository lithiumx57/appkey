<?php

namespace App\Models;

use App\Infrastructure\Contracts\IFavoritable;
use App\Panel\helpers\XModelHelper;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $user_id
 * @property $model
 * @property $model_id
 */
class Favorite extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];


  public const MODELS = [
    "product" => Product::class,
  ];


  /**
   * @throws Exception
   */
  public static function switch($model = null, $modelId = null): bool
  {
    $user = auth()->user();
    if (!$user) throw new  Exception("برای افزودن رکورد به علاقه مندی ها ابتدا وارد حساب کاربری خود شوید");
    if (!$model) throw new  Exception("خطایی رخ داده است");
    if (!@self::MODELS[$model]) throw new  Exception("خطایی رخ داده است");
    $model = self::MODELS[$model];
    $record = $model::find($modelId);
    if (!($record instanceof $model)) throw new  Exception("رکورد یافت نشد");
    if (!$record->approved) throw new  Exception("رکورد تایید نشده است");


    $favorite = static::where(["user_id" => $user->id, "model_id" => $modelId, "model" => $model])->first();
    if ($favorite) {
      $favorite->delete();
      return false;
    } else {
      static::create(["user_id" => $user->id, "model_id" => $modelId, "model" => $model]);
      return true;
    }

//    return self::getAll();
  }

  public static function isInFavorite($model, $modelId): bool
  {
    return !!static::where(["user_id" => auth()->user()->id, "model_id" => $modelId, "model" => $model])->count();
  }


  public static function getModelKey($model): string|null
  {
    foreach (self::MODELS as $key => $value) {
      if ($model == $value) return $key;
    }
    return null;
  }

  public static function getAll(): array
  {
//    $userId=auth()->user()->id;
    $userId = 1;

    if (!auth()->check()) return [];
    $result = static::where("user_id", $userId)->get();

    $records = [];
    foreach ($result as $row) {
      $model = self::getModelKey($row->model);
      if ($model == null) continue;

      $key = @$records[$model];
      if (!$key) $records[$model] = [];
      $records[$model][] = $row->model_id;
    }

    return $records;
  }

  public static function castAll(): array
  {
    $data = self::getAll();


    $records = [];

    foreach ($data as $model => $values) {
      $favorites = self::MODELS[$model]::whereIn("id", $values)->get();
      if ($favorites->count() == 0) {
        continue;
      }

      $records[$model] = [];

      foreach ($favorites as $favorite) {
        if (!($favorite instanceof IFavoritable)) continue;
        $records[$model][] = [
          "image" => $favorite->getImage(),
          "title" => $favorite->getTitle(),
          "link" => $favorite->getLink(),
          "model" => $model,
          "modelId" => $favorite->id
        ];
      }
    }

    return $records;
  }

  public function getModel()
  {
    return $this->model::find($this->model_id);
  }

}
