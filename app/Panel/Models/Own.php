<?php

namespace App\Panel\Models;

use App\Panel\Dynamic\LiModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\RedirectResponse;

class Own extends LiModel
{
  protected ?string $title = "نقش";
  protected bool $saveButton = true;
  protected bool $cancelButton = false;
  protected $positionTitle = "ویرایش تنظیمات ادمین";

  protected ?string $guide = "در صورت عدم آگاهی از تنظیمات این بخش ، قبل از تغییر با توسعه دهنده در ارتباط باشید";

  public function xMenuOff(): bool
  {
    return true;
  }

  public static function xObjectPreCreate(callable $next): RedirectResponse
  {

    foreach (getConfigurator()->getOwns() as $function => $label) {
      $data = getXRequest("roles_" . $function);

      $own = Own::where("function", $function)->first();
      if ($data == null) $data = [];
      if ($own instanceof Own) $own->roles()->sync($data);
    }
    showSuccessMessage();
    return back();
  }

  public function fields(): array
  {
    $this->checkFunctions();
    $fields = [];

    foreach (getConfigurator()->getOwns() as $function => $label) {
      $fields[] = xField()->manyToMany("roles_" . $function, Role::class, "name")->label($label . " --- تابع " . "()" . $function)->customName($function)
        ->checkFromArray(static::where('function', $function)->first()->roles()->pluck('id')->toArray());
    }

    return $fields;
  }

  private function checkFunctions()
  {
    foreach (getConfigurator()->getOwns() as $function => $label) {
      if (!function_exists($function)) xError(" تعریف نشده است " . $function . " تابع ");
      $own = static::where('function', $function)->first();
      $data = ['function' => $function, 'label' => $label];
      if ($own instanceof Own) $own->update($data);
      else Own::create($data);
    }
  }

  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class);
  }
}
