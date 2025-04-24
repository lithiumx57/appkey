<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use App\Panel\helpers\ModelHelper;
use App\Panel\Menu\XMenus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PanelMenu extends LiModel
{
  public bool $menuOff = true;

  public $timestamps=false;

  public static array $customPermissions = [
    "can-change-panelmenu-menuOff" => "تغییر وضعیت"
  ];

  protected ?string $title = "منو های داشبورد";
  protected ?string $pluralTitle = "منو های داشبورد";

  public static ?string $sortField = "position";

  protected $casts = [
    'submenus' => 'array'
  ];


  public function actions(): array
  {
    return [
      xAction()->select()->setOptions([0 => "غیر فعال", 1 => "فعال"])->setThTitle("وضعیت")->setField("menuOff")
    ];
  }


  public function fields(): array
  {
    self::releaseMenus();
    return [
      xField()->string("pluralTitle")->showInTable()->label("عنوان منو"),
      xField()->fontAwesome("icon")->showInTable()->label("آیکن"),

      xField()->br(),
      xField()->group([
        xField()->color("menuIconColor")->showInTable()->label("رنگ آیکن منو"),
        xField()->color("menuTextColor")->showInTable()->label("زنگ نوشته منو")
      ]),
      xField()->br(),
    ];
  }


  public static function releaseMenus()
  {
    $menus = XMenus::getMenus();
    foreach ($menus as $row) {

      $menu = static::where([
        "model" => $row->model
      ])->first();



      if (!($menu instanceof PanelMenu)) {
        static::create([
          "title" => $row->title,
          "pluralTitle" => $row->pluralTitle,
          "url" => $row->url,
          "submenus" => $row->submenus,
          "hasSubmenu" => $row->hasSubmenu,
          "icon" => $row->icon,
          "arrow" => $row->arrow,
          "menuIconColor" => $row->menuIconColor,
          "menuTextColor" => $row->menuTextColor,
          "menuOff" => false,
          "model" => $row->model,
        ]);
      } else {
        $menu->update([
//          "title" => $row->title,
//          "pluralTitle" => $row->pluralTitle,
          "url" => $row->url,
          "submenus" => $row->submenus,
          "hasSubmenu" => $row->hasSubmenu,
          "icon" => $row->icon,
          "arrow" => $row->arrow,
          "menuOff" => false,
        ]);
      }

    }
  }

  public static function disable(): XDisable
  {
    return xDisable()->copy()->delete()->create()->trash();
  }


}
