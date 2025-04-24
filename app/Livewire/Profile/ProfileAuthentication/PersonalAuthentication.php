<?php

namespace App\Livewire\Profile\ProfileAuthentication;

use Carbon\Carbon;
use Error;
use Exception;
use Livewire\Component;
use Throwable;

class PersonalAuthentication extends Component
{
  public bool $isOpened = false;
  public string|null $name = "";
  public string|null $family = "";
  public string|null $nationCode = "";
  public string|null $birthDate = "";
  public $authenticated = false;

  protected $listeners = [
    "refresh-email" => '$refresh'
  ];


  public function mount(): void
  {
    $user = auth()->user();
    if ($user->nation_code) {
      $this->nationCode = $user->nation_code;
      $this->name = $user->name;
      $this->family = $user->family;
      try {
        $this->birthDate = convertToJalali($user->birthday,"Y/m/d");
      }catch (Exception|Error|Throwable) {
      }
      $this->authenticated = true;
    } else {
      $this->authenticated = false;
    }
  }

  public function openAutentication()
  {
    $this->isOpened = true;
  }

  public function confirm(): void
  {

    try {
      validate()->validateString($this->name, "نام", min: 3, max: 20);
      validate()->validateString($this->family, " نام خانوادگی", min: 3, max: 20);
      validate()->validateString($this->nationCode, "کد ملی", equals: 10);

      try {
        $date = Carbon::parse(convertToGregory($this->birthDate));
        if ($date->greaterThan(Carbon::now()->subYears(5))) {
          throw new Exception("تاریخ نامعتبر است");
        }

        if ($date->lessThan(Carbon::now()->subYears(80))) {
          throw new Exception("تاریخ نامعتبر است");
        }


      } catch (Exception) {
        throw new Exception("تاریخ نامعتبر است");
      }

      auth()->user()->update([
        "nation_code" => $this->nationCode,
        "birthday" => $date,
        "name" => $this->name,
        "family" => $this->family,
      ]);

      $this->authenticated = true;
      $this->isOpened=false;
      toast($this,"احراز هویت با موفقیت انجام شد","success");
    } catch (Exception $exception) {
      toast($this, $exception->getMessage(), "error");
    }
  }


  public function render()
  {

    return view('livewire.profile.profile-authentication.personal-authentication');
  }
}
