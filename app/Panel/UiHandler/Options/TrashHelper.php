<?php


namespace App\Panel\UiHandler\Options;


use App\Panel\Controllers\AdminController;
use App\Panel\helpers\XConditionsHelper;
use App\Panel\helpers\XPermissionHelper;
use App\Panel\Singleton\XModelSingleton;
use Illuminate\Database\Eloquent\SoftDeletes;

trait TrashHelper
{




  public function canViewTrash(): array
  {

    if (XModelSingleton::getModel($this->model)::disable()->has("trash")) return [false,""];
    $hasTrash = hasTrait($this->model, SoftDeletes::class);

    if ($hasTrash & $this->hasOption(XOptions::DEFAULT_OPTION_TRASH)) {
      if (XPermissionHelper::can("trash", $this->model)) {
        return [
          true, ""
        ];
      }
      return  $this->initDebugMode();
    }
    if ($hasTrash){
      return  $this->initDebugMode();
    }
    return [false,""];


  }

  public function buildTrashOption():void
  {
    $data=$this->canViewTrash();
    if ($data[0]) {

      $additionalRoute = XConditionsHelper::create();
      if (strlen($additionalRoute) > 0) {
        $additionalRoute .= "&trash=true";
      } else {
        $additionalRoute .= "?trash=true";
      }



      $count=AdminController::$model::onlyTrashed()->count();
      $this->initializedOptions[] = XOption::getInstance()
        ->setLink( buildRoute(\App\Panel\helpers\ModelHelper::convertModelToRoute($this->model)).$additionalRoute)
        ->setIcon("fa fa-trash")
        ->setClazz($data[1])
        ->setType(XOptions::DEFAULT_OPTION_TRASH)
        ->setTitle("سطل زباله "  . " ( ".$count." ) ")
        ->build();
    }
  }

}
