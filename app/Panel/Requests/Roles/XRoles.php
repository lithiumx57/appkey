<?php


namespace App\Panel\Requests\Roles;


use App\Panel\Controllers\AdminController;
use App\Panel\UiHandler\Elements\Element;
use App\Panel\UiHandler\XFieldHelper;

class XRoles
{
  private static function getPrimitiveData(): array
  {
    $result = [];
    $fields = XFieldHelper::getMergedFields(AdminController::$model);
    foreach ($fields as $field) {
      if ($field instanceof Element) {
        $row = [];
        $row['name'] = $field->name;
        $row['type'] = $field;
        $row['roles'] = collect($field->role)->toArray();
        $result[] = $row;
      }
    }
    return $result;
  }

  public static function buildRules(): array
  {
    if (isDeleteMethod()) return [];

    $primitiveData = self::getPrimitiveData();
    $rules = [];
    foreach ($primitiveData as $row) {
//      if ($row['type'] instanceof XTimestamps) {
//        $name = $row['name'];
//        $time = "time" . $name;
//        $date = $name;
//        showRequests();
//
//        showRequests();
//      }
      $rules = array_merge($rules, (new XRole())->init($row));
    }
    return $rules;
  }
}
