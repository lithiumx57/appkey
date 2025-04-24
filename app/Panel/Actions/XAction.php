<?php

namespace App\Panel\Actions;

use App\Panel\helpers\XPermissionHelper;
use App\Panel\helpers\XStringHelper;

class XAction
{
  public bool $isSeparateTd = false;
  public array $conditions = [];
  public string $title = "بدون عنوان";
  public string $classes = "fa fa-list";
  public bool $isLinkMode = false;
  public array $permissions = [];
  private bool $isSetClasses = false;
  public bool $isButtonMode = false;
  public string $thTitle = "-";
  public string $link = "#";
  public ?string $type = null;
  public array $attributes = [];


  public function separateTd()
  {
    $this->isSeparateTd = true;
    return $this;
  }


  public function setThTitle(string $title)
  {
    $this->thTitle = $title;
    return $this;
  }


  public function addClass($class)
  {
    if (!$this->isSetClasses) {
      $this->isSetClasses = true;
      $this->classes = "";
    }

    $this->classes .= " " . $class;
    return $this;
  }

  public function addPermission(array $permissions = [])
  {
    $this->permissions = array_merge($this->permissions, $permissions);
    return $this;
  }


  public function addCondition(array $condition)
  {
    $this->conditions = array_merge($this->conditions, $condition);
    return $this;
  }


  public function setTitle(?string $title)
  {
    if ($title == null) $title = "";
    $this->title = $title;
    return $this;
  }


  public function hasPermission()
  {
    foreach ($this->permissions as $permission) {
      if (!XPermissionHelper::hasCustomPermission($permission)) {
        return false;
      }
    }
    return true;
  }

  private function buildUrl($url)
  {
    if (XStringHelper::startWith($url, "/")) return $url;
    return "/" . $url;
  }


  public function buildAttributeFromArray(array $array)
  {
    $result = "";
    if ($this instanceof XActionLink) {
      foreach ($array as $key => $value) $result .= "data-" . $key . "=" . '"' . $value . '" ';

      $result .= "href" . "=" . '"' . $this->buildUrl($this->link) . '" ';
      $result .= "data-type" . "=" . '"' . $this->type . '" ';
      $result .= "data-is-link-mode" . "=" . '"' . $this->isLinkMode . '" ';
      return $result;
    } else {
      foreach ($array as $key => $value) $result .= "data-" . $key . "=" . '"' . $value . '" ';
      $result .= "data-type" . "=" . '"' . $this->type . '" ';
      $result .= "data-is-link-mode" . "=" . '"' . $this->isLinkMode . '" ';
    }
    return $result;
  }

}
