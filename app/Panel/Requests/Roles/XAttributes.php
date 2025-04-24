<?php


namespace App\Panel\Requests\Roles;


use App\Panel\Controllers\AdminController;
use App\Panel\UiHandler\Elements\Element;
use App\Panel\UiHandler\XFieldHelper;

class XAttributes {

  public static function buildAttributes(): array
  {
    $fields = XFieldHelper::getMergedFields(AdminController::$model);
    $result = [];
    foreach ($fields as $field) {
      if ($field instanceof Element) {
        if ($field->view->label != "") {
          $value = $field->view->label;
        } elseif (@VALIDATION[$field->name] != null) {
          $value = VALIDATION[$field->name];
        } else {
          $value = $field->name;
        }
        $result[$field->name] = $value;
      }
    }
    return $result;
  }
}
