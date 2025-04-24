<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use App\Panel\Menu\XMenu;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $name
 * @property $type
 * @property $extension
 * @property $prefix
 * @property $unique
 * @property $created_at
 */
class Attachment extends LiModel
{

  protected $guarded=["id"];
  public $timestamps = false;
  protected ?string $title = "پیوست";
  public const TYPE_VIDEO = "video";
  public const TYPE_IMAGE = "image";

  protected bool $isTableOff = true;
  public static ?string $indexView = "attachment";

//  protected $casts = [
//    "path" => "array",
//    "extensions" => "array",
//    "sizes" => "array",
//  ];

  public function menu(): ?XMenu
  {
    return xMenu("پیوست ها", [], "attachments");
  }


  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->menuOff = true;
  }


  public function fields(): array
  {
    return [
      xField()->string("name")->showInTable(),
      xField()->string("path")->showInTable(),
      xField()->string("extension")->showInTable(),
      xField()->string("file_size")->showInTable(),
    ];
  }


  public function getType(): string
  {
    return $this->type;
  }

  public function getLink($pathFromDisc = false): string|null
  {
//    dd($this);
    $date = Carbon::parse($this->created_at);
    $year = $date->year;
    $month = $date->month;
    if ($month < 10) $month = "0" . $month;
//    dd($this->name);

    if (getConfigurator()->getCdnDir()) {
      $prefix = $pathFromDisc ? getConfigurator()->getCdnDir() : getConfigurator()->getCdnWebsite();
      return strtolower($prefix . "/files/" . $this->prefix . "/" . $year . "/" . $month . "/" . $this->unique . "_" . $this->name . "." . $this->extension);
    } else {
      return strtolower("/files/" . $this->prefix . "/" . $year . "/" . $month . "/" . $this->unique . "_" . $this->name . "." . $this->extension);
    }
  }

  public static function disable(): XDisable
  {
    return \xDisable()->copy()->edit()->create()->trash()->delete();
  }

  public function removeFiles(): void
  {
    $result = $this->getLink(true);
    if (file_exists($result)) unlink($result);
  }


}
