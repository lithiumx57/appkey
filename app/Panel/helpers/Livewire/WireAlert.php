<?php

namespace App\Panel\helpers\Livewire;


class WireAlert
{

  public static function getInstance(): WireAlert
  {
    return new WireAlert();
  }


  public function success($component, $messages="عملیات با موفقیت انجام شد")
  {
    return $this->alert($component, $messages);
  }

  public function warning($component, $messages)
  {
    return $this->alert($component, $messages, "تایید", "هشدار", "warning");
  }

  public function error($component, $messages)
  {
    return $this->alert($component, $messages, "تایید", "خطا", "error");
  }


  public function info($component, $messages)
  {
    return $this->alert($component, $messages, "تایید", "اطلاعات", "info");
  }

  public function message($component, $messages)
  {
    return $this->alert($component, $messages, "تایید", "اطلاعات", "message");
  }


  private function alert($component, $messages, $confirmText = "تایید", $title = "موفق", $type = "success")
  {
    if (!is_array($messages)) $messages = [$messages];
    $records = [];
    foreach ($messages as $row) $records[] = $row;
    return $component->dispatch("wire-alert", $title, $records, $type, $confirmText, false);
  }
}
