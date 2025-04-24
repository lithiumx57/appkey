<?php


namespace App\Panel\UiHandler\Menu;


use App\Panel\helpers\ModelHelper;

class XMenu {

  public static function render()
  {
    $models = ModelHelper::getModels();
    return view('layouts.menu', compact('models'));
  }

}
