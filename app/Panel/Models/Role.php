<?php

namespace App\Panel\Models;

use App\Models\User;
use App\Panel\Dynamic\LiModel;
use App\Panel\Dynamic\XDisable;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Menu\XMenu;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Role extends LiModel
{
  protected ?string $title = "سطح دسترسی";
  protected ?string $pluralTitle = "سطوح دسترسی";
  public ?string $menuIcon = "fa fa-lock";
  use SoftDeletes;

  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    $this->menuOff = true;
  }

  public function menu(): XMenu
  {
    return xMenu("سطوح دسترسی", [
      xSubmenu("افزودن یک مورد جدید", "roles/create", "fa fa-pencil","post-role"),
      xSubMenu("همه موارد ثبت شده", "roles", "fa fa-list","view-role"),
      xSubMenu("سطل زباله", "roles?trash=true", "fa fa-trash","trash-role"),
    ]);
  }

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  public function options(): array
  {

    return [
      xOptionCustom("همگام سازی", "fa fa-recycle", false, true, "syncPermissions", null,static::class,
        "با انتخاب این گزینه همه دسترسی ها حذف و دوباره ایجاد می شوند( این گزینه فقط در حالت دیباگ یا توسعه فعال است )"
      ),
      xOptionCustom("ثبت permissions های جدید", "fa fa-recycle", false, false, "releasePermissions",null,static::class
//        "با زدن این گزینه هیچ چیزی حذف نمی شود و فقط دسترسی های جدید اضافه می شود"
      ),
    ];
  }

  public static function releasePermissions()
  {
    XPermissionHelper::releasePermissions();
    return back();
  }


  public static function syncPermissions()
  {
    DB::table("permission_role")->truncate();
    DB::table("permissions")->where([])->delete();
    self::releasePermissions();
  }

  public function fields(): array
  {
    return [
      xField()->string("name")->label("نام")->showInTable()->minFilter(2)->maxFilter(60),
      xField()->string("description")->nullable()->label("توضیحات")->maxFilter(60)->placeholder("غیر الزامی")->showInTable(),
      xField()->permission("permissions")->nullable(),
    ];
  }


  public function permissions()
  {
    return $this->belongsToMany(Permission::class);
  }


}
