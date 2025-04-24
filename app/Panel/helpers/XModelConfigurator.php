<?php


namespace App\Panel\helpers;

use App\Panel\Menu\XMenu;

trait XModelConfigurator
{

  public static function isDynamicPanelMode()
  {
    return true;
  }

  protected function getContainerClass()
  {
    return "col-md-12 col-xl-8";
  }


  public function actions(): array
  {
    return [];
  }


  public function fields(): array
  {
    return [];
  }

  public function __toString()
  {
    return $this->title == null ? "" : $this->title;
  }


  public static function xObjectPreCreate(callable $next)
  {
    return $next();
  }

  public function xObjectCreating(callable $next)
  {
    return $next();
  }

  public function xObjectCreated(callable $next)
  {
    return $next();
  }


  public function xObjectPreUpdate(callable $next)
  {
    return $next();
  }


  public static function xPreCreateFormRendered(callable $next)
  {
    return $next();
  }

  public function xPreEditFormRendered(callable $next)
  {
    return $next();
  }

  public function xObjectUpdating(callable $next)
  {
    return $next();
  }

  public function xObjectUpdated(callable $next)
  {
    return $next();
  }

  public function xObjectDeleting(callable $next)
  {
    return $next();
  }

  public function xObjectRestoring(callable $next)
  {
    return $next();
  }


  public function xObjectPreSwitch(callable $next)
  {
    return $next();
  }

  protected function xCustomView()
  {
    return null;
  }

  public function xObjectPreEdit(callable $next)
  {
    return $next();
  }

  public static function xRules(): array
  {
    return [];
  }


  public static function xAttributes(): array
  {
    return [];
  }


  public function menu(): ?XMenu
  {
    return null;
  }

  public function trStyles()
  {
    return "";
  }


  public function queryRoles(): array
  {
    return [];
  }

  public function scopeGetQueryRoles()
  {
    return $this->queryRoles();
  }

  public static function getEditData()
  {
    return null;
  }

  public function xPermissions(): array
  {
    return [];
  }

  public function scopeGetRoute(): string
  {
    return XRouteHelper::getRoute($this);
  }


  public function xObjectPreSwitchableFieldChange($next)
  {
    return $next();
  }

  public function xObjectSwitchableFieldChange($next)
  {
    return $next();
  }

  public function xObjectPreCopy($next)
  {
    return $next();
  }

  public function xObjectCoping($newObject, $next)
  {
    return $next();
  }


  public function xObjectSyncing( $next)
  {
    return $next();
  }

  public function xObjectCoppied($newObject, $next)
  {
    return $next();
  }


  public function sluggable(): array
  {
    $result = $this->slugFields;
    $data = [];
    foreach ($result as $key => $value) {
      $data[$key] = [
        "sourse" => $value
      ];
    }
    return $data;
  }

}
