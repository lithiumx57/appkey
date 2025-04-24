<?php

namespace App\Models;

use App\Panel\Menu\XMenu;
use App\Panel\Models\Role;
use App\Panel\Models\XUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;


/**
 * @property $id
 * @property $name
 * @property $username
 * @property $email
 * @property $birthday
 * @property $nation_code
 * @property $credit
 * @property $credit_confirmed
 * @property $mobile
 * @property $family
 * @property $is_admin
 * @property Collection<Role> $roles
 * @property $password
 * @property $created_at
 * @property $updated_at
 */
class User extends XUser
{
  use HasFactory, Notifiable;

  public ?string $menuIcon = "fa fa-user";



  public static array $customPermissions = [
    'can-change-user-permission' => "تغییر سطح دسترسی کاربر"
  ];

  protected $guarded = ["id"];




  public function menu(): ?XMenu
  {
    return xMenu("کاربران", [
      xSubmenu("افزودن کاربر جدید", "users/create"),
      xSubmenu("همه کاربران", "users"),
      xSubmenu("سطوح دسترسی", "roles"),
    ]);
  }


  public function fields(): array
  {
    $data = [
      xField()->string("name")->showInTable()->maxFilter(30)->minFilter(2),
      xField()->string("username")->showInTable()->ltr()->uniqueFilter("users")->showInTable(),
      xField()->password("password")->label("کلمه عبور")->label("کلمه عبور")->maxFilter(8)->maxFilter(50)->canView()->updateNotRequired(),
      xField()->bool("is_admin")->nullable()->switchable()->label("کاربر ادمین"),
    ];

    if (xHasPermission("can-change-user-permission")) {
      $data[] = xField()->manyToMany('roles', Role::class, "name")->label("دسترسی ها")->nullable()->showInTable();
    }
    return $data;
  }


  public static function getUsernameField(): string
  {
    return "username";
  }


  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class);
  }

  public function isAdmin()
  {
    return $this->is_admin;
  }

  public function getAvatar()
  {
    return "";
  }


}

