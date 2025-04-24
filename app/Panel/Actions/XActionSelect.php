<?php

namespace App\Panel\Actions;

use App\Panel\Controllers\AdminController;

class XActionSelect extends XAction
{
  public array $options = [];
  private string $field = "";
  private bool $confirmable = false;
  public bool $isSeparateTd = true;

  public bool $isMethodMode = false;
  public string $method = "";


  public function setOptions(array $options):XActionSelect
  {
    $this->options = $options;
    return $this;
  }

  /**
   * @param string $field
   * این فیلدی هست که با تغییر گزینه ها در دیتابیس تغییر می کند
   */

  public function setField(string $field):XActionSelect
  {
    $this->field = $field;
    return $this;
  }


  /**
   * @param array $permissions
    * این فیلد باید به صورت " can-change-model-field " باشد
   */

  public function addPermission(array $permissions = []):XActionSelect
  {
    $this->permissions = array_merge($this->permissions, $permissions);
    return $this;
  }


  public function setConfirmable(bool $confirmable = false):XActionSelect
  {
    $this->confirmable = $confirmable;
    return $this;
  }

  public function setMethodMode(bool $isMethodMode):XActionSelect
  {
    $this->isMethodMode = $isMethodMode;
    return $this;
  }

  public function setMethod(string $method):XActionSelect
  {
    $this->method = $method;
    return $this;
  }




  public function build():void
  {
    $this->attributes = [
      "is-method" => $this->isMethodMode,
      "method" => $this->method,
      "field" => $this->field,
      "confirmable" => $this->confirmable,
      "model" => str_replace("\\", "/", AdminController::$model),
      "type" => "DEFAULT_ACTION_SELECT",
    ];
  }


}
