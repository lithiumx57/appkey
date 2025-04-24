<?php

namespace App\Panel\Models;

use App\Models\User;
use App\Panel\helpers\XModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property $id
 * @property $message
 * @property $user_id
 * @property User $user
 * @property $created_at
 * @property $updated_at
 */
class Notification extends Model
{
  use XModelHelper;

  protected $guarded = ["id"];


  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }


  public static function motificationCreator($message, $targets)
  {

    $result = static::create([
      "message" => $message,
      "user_id" => user()->getId(),
    ]);


    if ($result instanceof \App\Panel\Models\Notification) {
      $result->users()->sync($targets);
    }
  }


  public static function getNotificationCount(): int
  {
    return DB::table("notification_user")->where([
      "user_id" => user()->getId(),
      "seen" => false
    ])->count();
  }

  public static function getNotifications(): Collection
  {
    return static::with("user")
      ->join("notification_user", "notifications.id", "=", "notification_user.notification_id")
      ->where("notification_user.user_id", user()->getId())
      ->orWhere("notifications.user_id", user()->getId())
      ->select(["notifications.*", "notification_user.seen"])
      ->latest()
      ->get();
  }


  public function hasBeenSeen()
  {
    $result = DB::table("notification_user")->where([
      "user_id" => user()->getId(),
      "notification_id" => $this->id,
    ])->first();
    if ($result) return $result->seen;
    return false;
  }

  public function switchSeen()
  {
    $role = ["user_id" => user()->getId(), "notification_id" => $this->id];
    $result = DB::table("notification_user")->where($role)->first();
    if ($result->seen) DB::table("notification_user")->where($role)->update(["seen" => 0]);
    else DB::table("notification_user")->where($role)->update(["seen" => 1]);
  }

  public function buildMessage(): string
  {
    $data = preg_replace("/%order(.*)order%/", "<span style='cursor: pointer;;color: #fff;border-bottom: 1px dashed #fff' onclick='showOrderDetails($1)'>$1</span>", $this->message);
    $data = preg_replace("/%ot(.*)ot%/", "<span style='cursor: pointer;;color: #fff;border-bottom: 1px dashed #fff' onclick='goToOrderTask($1)'>$1</span>", $data);

    return $data;
  }

}
