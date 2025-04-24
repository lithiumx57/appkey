<?php


namespace App\Panel\Models;


use App\Panel\Dynamic\LiModel;
use App\Panel\Menu\XMenu;

class PanelModel extends LiModel
{

  public const ESCAPES = [
    \App\Panel\Models\Panel::class,
    \App\Panel\Models\LanguageData::class,
  ];


  protected ?string $title = 'تنظیمات پنل';
  protected ?string $pluralTitle = 'تنظیمات پنل';

  public $timestamps = false;

  public function scopeGetPositionTitle(): ?string
  {

    $type = getXRequest("type");

    if ($type == "search") {
      return "تعیین فیلد های جست و جو";
    }
    return "";
  }


  protected $casts = [
    "data" => "array"
  ];


  public function menu(): ?XMenu
  {
    return xMenu("تنظیمات پنل", [
      xSubmenu('تنظیمات جست و جو در مدل', "panelmodels/create?type=search", "fa fa-search"),
      xSubmenu('منو های داشبورد', "panelmenus", "fa fa-list"),
    ]);
  }


  public function fields(): array
  {
    return [
      xField()->custom("search-config")->viewPath("custom.search-config")->nullable()
    ];
  }


  public static function xObjectPreCreate(callable $next)
  {
    $search = getXRequest("search");
    $result = [];

    foreach ($search as $model => $fields) {
      $keys = array_keys($fields);
      $result[$model] = $keys;
    }

    self::getSearchRow()->update([
      "data" => $result
    ]);
    return back();
  }

  public static function getSearchRow(): PanelModel
  {
    $result = static::where("type", "search")->first();
    if (!($result instanceof PanelModel)) {
      $result = PanelModel::create([
        "type" => "search",
        "data" => ""
      ]);
    }
    return $result;
  }


}
