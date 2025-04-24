<?php


namespace App\Panel\helpers;


use App\Panel\UiHandler\Elements\XGroup;

class XFieldMerger
{
  private $fields = [];

  public function merge($fields): array
  {
    foreach ($fields as $field) {
      if ($field instanceof XGroup) {
        $this->merge($field->getElements());
        continue;
      }
      $this->fields[] = $field;
    }
    return $this->fields;
  }
}