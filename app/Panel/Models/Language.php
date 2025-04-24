<?php


namespace App\Panel\Models;


use App\ApiHelpers\CastTraits\LanguageCast;
use App\Panel\Dynamic\LiModel;
use App\Panel\helpers\XFileHelper;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * @property $id
 * @property $title
 * @property $name
 * @property $flag
 * @property $approved
 * @property $is_default
 * @property $direction
 * @property $type
 * @property $last_update
 * @property $created_at
 * @property $updated_at
 */
class Language extends LiModel
{


  protected ?string $title = 'زبان';
  public ?string $menuIcon = 'fa fa-language';

  public static array $customPermissions = [
    "language-data-acces-from-language" => 'دسترسی به داده های زبان'
  ];

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->menuOff = !Schema::hasTable("languages");
  }


  public static function get($lang): Language
  {
    $result = static::where("name", $lang)->where("approved", true)->first();
    if (!($result instanceof Language)) {
      self::releaseDefaultLanguage();
      return self::get("fa");
    }
    return $result;
  }

  private static function releaseDefaultLanguage(): Language
  {
    $result = static::where("name", "fa")->first();
    if (!($result instanceof Language)) {
      $result = static::create([
        'name' => 'fa',
        'title' => "فارسی",
        'flag' => [
          64 => "/dashboard/images/flags/iran.png",
          500 => "/dashboard/images/flags/iran.png"
        ],
        'apprpved' => true,
        'is_default' => true,
        'direction' => 'rtl',
      ]);
    }
    return $result;
  }

  public static function getDefault(string $lang, $type)
  {
    $result = static::where('name', $lang)->where("type", $type)->first();
    if (!($result instanceof Language)) {
      $result = self::releaseDefaultLanguage();
    }
    return $result;
  }


  public function actions(): array
  {
    return [
      xAction()->link()->setLink("/languagedatas?lang=" . $this->id)
        ->addPermission(["language-data-acces-from-language"])
        ->setTitle("داده ها")
        ->addClass("fa fa-list")

    ];
  }

  public function xObjectPreSwitch(callable $next)
  {
    if (getXRequest("switch") == "is_default") {
      DB::table('languages')->update([
        'is_default' => false
      ]);
      $this->update([
        'is_default' => true
      ]);
      return back();
    }
    return $next();
  }


  public function xObjectCreating(callable $next)
  {
    $name = $this->name . "_" . $this->type;

    $path = lang_path('json/' . $name . ".json");

    $result = is_file($path);
    if (!$result) {
      XFileHelper::createFile($path);
    }
    return $next();
  }

  protected $casts = [
    'flag' => 'array'
  ];

  public function fields(): array
  {
    return [
      xField()->string("title")->showInTable(),
      xField()->string("name")->showInTable(),
      xField()->image("flag")->showInTable()->uploadPath("flags")->sizes(64, 500)->label("پرچم"),
      xField()->bool("approved")->showInTable()->switchable(),
      xField()->select("type")->label("تایپ")->options(["main" => "سایت اصلی", "dashboard" => "داشبورد"])->showInTable(),
      xField()->bool("is_default")->showInTable()->switchable()->label("زبان پیشفرض"),
      xField()->select("direction")->options(['rtl' => 'راست به چپ', 'ltr' => 'چپ به راست'])->showInTable()->label("جهت"),
      xField()->td("داده ها", "getDataButton"),
    ];
  }


  public function getDataButton(): string
  {
    if ($this->id) {
      $link = buildRoute("/languagedatas?lang=" . $this->name);
      return "<a class='btn btn-success' href='" . $link . "'>داده ها</a>";
    }
    return "";
  }


}
