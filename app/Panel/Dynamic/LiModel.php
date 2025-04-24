<?php


namespace App\Panel\Dynamic;


use App\Panel\helpers\ModelHelper;
use App\Panel\helpers\XModelConfigurator;

abstract class LiModel extends XModel
{
  use  XModelConfigurator;

  public function options(): array
  {
    return [

    ];
  }



  private function getCalledName()
  {
    $className = get_class($this);
    return ModelHelper::getName($className);
  }

  public function scopeUseSoftDelete()
  {
    $classPath = get_class($this);
    return $this->scopeShowTrash() && hasArrayIndex(class_uses($classPath), "Illuminate\Database\Eloquent\SoftDeletes");
  }


  public function scopeIsEditMode()
  {
    return $this->getEditData() != null;
  }

}
