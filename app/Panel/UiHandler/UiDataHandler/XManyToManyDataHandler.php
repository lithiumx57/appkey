<?php

namespace App\Panel\UiHandler\UiDataHandler;

use App\Panel\Dynamic\LiModel;
use App\Panel\UiHandler\Elements\XManyToMany;
use Illuminate\Support\Collection;

class XManyToManyDataHandler
{

  private ?Collection $records = null;


  public static function getInstance(): XManyToManyDataHandler
  {
    return new XManyToManyDataHandler();
  }


  public function build(XManyToMany $element): XManyToManyDataHandler
  {
    $fillAble = $element->view->fillAble;
    $model = $element->relation->targetRelationClass;
    $conditions = $element->query->conditions;
    $renderField = $element->view->renderField;
    $relationConditions = $element->relationConditions;
    $primaryKey = $element->query->primaryKey;


    if (!is_array($renderField)) {
      $renderField = [$renderField];
    }
    $renderField[] = $primaryKey;

    if ($element->view->customName != null) $name = $element->view->customName;
    else $name = $element->name;

    $olds = old($name);
    if ($olds == null) $olds = [];


    $selectFields = [];
    $withFields = [];
    foreach ($renderField as $currentField) {
      if (str_contains($currentField, '.')) {
        $fieldParts = explode('.', $currentField);
        $withFields[] = $fieldParts[0];
        $selectFields[] = $fieldParts[0] . '_id';
      } else {
        $selectFields[] = $currentField;
      }
    }


    if (isEditMode()) {
      if (is_array($relationConditions) && count($relationConditions) > 0) {
        $selectedRows = $element->record->$name()->withPivot(array_keys($relationConditions))->where($relationConditions)->get();
      } else {
        $selectedRows = $element->record->$name()->get();
      }

//      $this->records = $selectedRows;

      $this->records = $model::where($conditions)->with($withFields)->select($selectFields)->get();

      $i = 0;
      foreach ($this->records as $record) {
        $record->renderDataField = $this->render($record, $renderField);
        $record->renderValueField = $record->$primaryKey;


        $checkFromArray = $element->view->checkFromArray;
        if (!is_array($checkFromArray)) $checkFromArray = [];

        $isInDefaultArray = hasArrayIndex($checkFromArray, $record->$primaryKey);


        if ($selectedRows->contains($primaryKey, "=", $record->$primaryKey) || hasArrayIndex($olds, $record->$primaryKey) || $isInDefaultArray) {
          $record->foreignDataSelected = true;
          $i++;
        }

        $this->records->add($record);
      }


      return $this;
    } else {
      $selectedRows = new Collection();

      if ($element->view->bigData) {
        $this->records = new Collection();
        return $this;
      }

    }

    $temp = $model::where($conditions)->with($withFields)->select($selectFields)->get();

    $i = 0;
    $this->records = new Collection();
    foreach ($temp as $record) {
      $record->renderDataField = $this->render($record, $renderField);
      $record->renderValueField = $record->$primaryKey;


      $checkFromArray = $element->view->checkFromArray;
      if (!is_array($checkFromArray)) $checkFromArray = [];

      $isInDefaultArray = hasArrayIndex($checkFromArray, $record->$primaryKey);


      if ($selectedRows->contains($primaryKey, "=", $record->$primaryKey) || hasArrayIndex($olds, $record->$primaryKey) || $isInDefaultArray) {
        $record->foreignDataSelected = true;
        $i++;
      }

      $this->records->add($record);
    }

    return $this;

  }

  private function render($record, $renderField)
  {
    $result = "";
    $i = 0;
    foreach ($renderField as $row) {
      if (str_contains($row, '.')) {
        $fieldParts = explode('.', $row);
        $relationModel = $fieldParts[0];
        $relationField = $fieldParts[1];
        $result .= $record->$relationModel->$relationField;
      } else {
        $result .= $record->$row;
      }

      $i++;
      if ($i > count($renderField)) $result .= " - ";
    }

    return $result;

  }

  public function getRecords(): Collection
  {
    return $this->records;
  }
}
