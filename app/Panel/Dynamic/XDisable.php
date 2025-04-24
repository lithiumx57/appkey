<?php

namespace App\Panel\Dynamic;

class XDisable
{
  private bool $copy = true;
  private bool $trash = true;
  private bool $edit = true;
  private bool $delete = true;
  private bool $create = true;
  private bool $index = true;
  private bool $restore = true;


  public static function getInstance(): XDisable
  {
    return new XDisable();
  }

  public function copy(): XDisable
  {
    $this->copy = false;
    return $this;
  }

  public function edit(): XDisable
  {
    $this->edit = false;
    return $this;
  }

  public function delete(): XDisable
  {
    $this->delete = false;
    return $this;
  }

  public function create(): XDisable
  {
    $this->create = false;
    return $this;
  }

  public function index(): XDisable
  {
    $this->index = false;
    return $this;
  }

  public function trash(): XDisable
  {
    $this->trash = false;
    return $this;
  }


  public function restore(): XDisable
  {
    $this->restore = false;
    return $this;
  }


  public function isEnable($mode): bool
  {
    return $this->$mode;
  }

  public function has($name): bool
  {
    return !$this->$name;
  }


  public function hasActions($type = "and", ...$actions): bool
  {
    if ($type == "and") {
      foreach ($actions as $action) if (!$this->$action) return false;
      return true;
    } else {
      foreach ($actions as $action) if ($this->$action) return true;
      return false;
    }
  }


}
